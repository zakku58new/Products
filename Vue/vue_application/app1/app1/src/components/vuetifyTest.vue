<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-list lines="one">
      <v-list-item
        v-for="n in 3"
        :key="n"
        :title="'item' + n"
        subtitle="hogehogehogehoge"
      ></v-list-item>
    </v-list>
    </v-navigation-drawer>
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container>Hello world</v-container>
      <v-list lines="one">
      <v-list-item
        v-for="n in 3"
        :key="n"
        :title="'item' + n"
        subtitle="hogehogehogehoge"
      ></v-list-item>
    </v-list>
    </v-main>
  </v-app>
</template>

<script lang="ts">
export default {

  data() {
    return {
      drawer: null,
    };
  },
  
};
</script>

<style scoped></style>