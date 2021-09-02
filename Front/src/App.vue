<template>
    <v-app>
        <header-component></header-component>
        <v-main>
            <router-view/>
        </v-main>
        <footer-component></footer-component>
    </v-app>
</template>

<script>

export default {
  name: 'App',
  data: () => ({
    //
  })
}
</script>
