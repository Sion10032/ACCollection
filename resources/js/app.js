import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue';
import Home from './components/Home.vue'
import 'normalize.css'


Vue.use(VueRouter)
Vue.use(VueAxios, axios)

Vue.prototype.$axios = axios

const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        components: {
            wrapper: Home
        }
    }
    ]
})

new Vue({
    el: '#app',
    router: router,
    render: app => app(App)
})
