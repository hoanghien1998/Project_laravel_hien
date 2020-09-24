<template>
    <div id="login-layout">
        <div class="container-login">
            <router-view/>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyCustomLayoutLogin"
}
</script>

<style scoped>
#login-layout{
    background-color: #a1cbef;
}
</style>
