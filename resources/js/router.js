import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from "./components/Home";
import Login from "./components/Login";

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        }
    ]
})
