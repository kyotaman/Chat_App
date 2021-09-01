<template>
  <div id="app">
    <HeaderView></HeaderView>
    <router-view/>
    <FooterView></FooterView>
  </div>
</template>

<script>
import HeaderView from '@/components/HeaderView'
import FooterView from '@/components/FooterView'
export default {
  name: 'App',
  components: {
    HeaderView,
    FooterView
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

</style>
