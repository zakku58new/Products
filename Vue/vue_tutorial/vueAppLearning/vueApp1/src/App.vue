<template>
<div>
    <!-- diffの前の「:」はv-bindの省略記法 -->
    <!-- v-bindは、親コンポーネントで値を変更した時、自動的に子コンポーネントの値も変更される。 -->
    <!-- 通常の属性では文字列しか渡せないので、数値などの他のオブジェクトを渡したい時にも使用。 -->
    <!-- locationは文字列のため、通常の属性で渡している。 -->
    <Clock class="clock" location="TOKYO" :diff="0"/>
    <Clock class="clock" location="NY" :diff="-14"/>
    <Clock class="clock" location="LA" :diff="-17"/>
    <Clock class="clock" location="UK" :diff="-9"/>
</div>
</template>

<script>
import Clock from "@/components/Clock"

export default {
    components: {
        Clock,
    },
}
</script>

<style scoped>
.clock {
    width: 80%;
    max-width: 500px;
    margin: 30px auto;
}
</style>
<style>
html {
    font-size: 62.5%;
}

body {
    margin: 0;
}

p {
    margin: 0;
}
</style>
