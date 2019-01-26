import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueCookie from 'vue-cookie'
import App from './App.vue';
import router from './routers.js'
import GeminiScrollbar from 'vue-gemini-scrollbar'
import 'normalize.css'


Vue.use(VueAxios, axios)
Vue.use(VueCookie)
Vue.use(GeminiScrollbar)

Vue.prototype.$axios = axios

new Vue({
    el: '#app',
    router: router,
    render: app => app(App)
})
