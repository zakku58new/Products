<template>
    <div>
        <div class="container">
            <!-- v-modelは、双方向データバインディングを行うもの -->
            <!-- inputの値とdataの値が常に同期される。 -->
            <!-- @はv-onの省略形 -->
            <!-- 修飾子 -->
            <!-- @event.stop : stopPropagationを実行 -->
            <!-- @event.prevent : preventDefaultを実行 -->
            <!-- @event.once : イベントを一度だけ実行 -->
            <!-- @event.{keyCode | keyAlias} : 指定したキーのみ実行 -->
            <!-- 他にもある！ -->
            <input class="text" type="text" v-model="term" @keyup.enter="exe">
            <input class="submit" type="submit" value="Search" @click="exe">
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            term: "",
        }
    },

    methods: {
        // async,awaitは、非同期処理を行う、vueとは関係ない
        // 取得したデータを$emitを通じて、親コンポーネントで受け取れるようにする。
        async exe() {
            // $emitは、イベントを送出するもの
            this.$emit("loadStart");
            const { data } = await axios.get(`//itunes.apple.com/search?term=${this.term}&country=jp&entity=musicVideo`);
            this.$emit("loadComplete", { results: data.results  });
        },
    },
};
</script>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    height: 70px;
    padding: 20px;
    background-color: #35495e;
    box-sizing: border-box;
}

.text {
    width: 50%;
    max-width: 300px;
    padding: .5em;
    border: none;
}

.submit {
    padding: .5em, 2em;
    margin-left: 10px;
    color: #fff;
    background-color: #42b883;
    border: none;
    border-radius: 20px;
}
</style>