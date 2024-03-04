<template>
<div style="display:block;">
  <div>
    <p>{{ firstName }}</p>
    <p>{{ lastName }}</p>
    <p>{{ fullName }}</p>
  </div>
  <div>
    <input type="text" v-model="sei" />
    <input type="text" v-model="mei" />
  </div>
  <button @click="newName">更新</button>
</div>
</template>

<script lang="ts">
export default {
  data() {
    return {
      firstName: "tarou",
      lastName: "saito",
      sei: "",
      mei: "",
    };
  },

  computed: {
    fullName: {
      // getter関数
      get() {
        return this.firstName + " " + this.lastName;
      },

      // setter関数
      set(newValue) {
        // ↓分割代入構文
        [this.firstName, this.lastName] = newValue.split(" ");
      },
    },
  },

  methods: {
    newName() {
      const newName = this.sei + " " + this.mei;
      this.fullName = newName;
    },
  },
};
</script>

<style scoped>
</style>