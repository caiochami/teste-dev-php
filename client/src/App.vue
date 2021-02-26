<template>
  <div id="app">
    <Navbar></Navbar>
    <router-view />
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";

export default {
  components: {
    Navbar,
  },
  created() {
    this.$store.dispatch("cars/get", { url: null });
    this.$store.dispatch("brands/get", { url: null });
  },
};
</script>
