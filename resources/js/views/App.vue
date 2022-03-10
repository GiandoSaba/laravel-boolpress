<template>
  <div>
    <Header></Header>
    <router-view></router-view>
  </div>
</template>

<script>
import Header from '../components/Header';
import Main from '../components/Main';
  export default {
    name: "App",
    components: {
        Header,
        Main,
    }
  }
</script>

<style lang="scss" scoped>
</style>
