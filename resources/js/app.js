import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue';
import router from './routers.js'
import 'normalize.css'


Vue.use(VueAxios, axios)

Vue.prototype.$axios = axios

new Vue({
    el: '#app',
    router: router,
    render: app => app(App)
})
