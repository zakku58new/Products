<template>
  <!-- <v-app id="inspire"> -->
    <!-- <v-navigation-drawer v-model="drawer" app> -->
      <!-- <v-list lines="one"> -->
      <!-- <v-list-item -->
        <!-- v-for="n in 3" -->
        <!-- :key="n" -->
        <!-- :title="'item' + n" -->
        <!-- subtitle="hogehogehogehoge" -->
      <!-- ></v-list-item> -->
    <!-- </v-list> -->
    <!-- </v-navigation-drawer> -->
    <!-- <v-app-bar app> -->
      <!-- <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon> -->
      <!-- <v-toolbar-title>Application</v-toolbar-title> -->
    <!-- </v-app-bar> -->

    <!-- <v-main> -->
      <!-- <v-container>Hello world</v-container> -->
      <!-- <v-list lines="one"> -->
      <!-- <v-list-item -->
        <!-- v-for="n in 3" -->
        <!-- :key="n" -->
        <!-- :title="'item' + n" -->
        <!-- subtitle="hogehogehogehoge" -->
      <!-- ></v-list-item> -->
    <!-- </v-list> -->
    <!-- </v-main> -->
  <!-- </v-app> -->
  
  <!-- <kakeibo/> -->
  <vuetify-test/>
</template>

<script lang="ts">
import VuetifyTest from './components/vuetifyTest.vue';
// import kakeibo from './components/Kakeibo.vue'

export default {
  components: {
    VuetifyTest,
    // kakeibo,
  },

  // data() {
  //   return {
  //     drawer: null,
  //   };
  // },

  // computed: {},

  // methods: {},
};
</script>

<style scoped>
</style>