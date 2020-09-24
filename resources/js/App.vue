<template>
    <div id="app">

        <div id="nav">
            <router-link :to="{ name: 'home' }">Home</router-link>|
            <router-link :to="{ name: 'login' }">Login</router-link> |
            <router-link :to="{ name: 'login-layout' }">Login-layout</router-link>
        </div>
        <vue-extend-layouts/>
    </div>
</template>

<script>
import VueExtendLayouts from 'vue-extend-layout'

export default {
    name: "App",
    components: {VueExtendLayouts}
}
</script>

<style lang="scss">
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

#nav {
    padding: 30px;

    a {
        font-weight: bold;
        color: #2c3e50;

        &.router-link-exact-active {
            color: #42b983;
        }
    }
}
</style>
