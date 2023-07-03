<script setup>
import NavBar from "./components/layouts/NavBar.vue";
const showLayouts = () => {
  return this.$route.path !== "/login" && this.$route.path !== "/register";
};
</script>

<template>
  <div class="flex" v-if="$route.meta.showNav">
    <NavBar />
  </div>
  <router-view></router-view>
</template>

<style scoped></style>
