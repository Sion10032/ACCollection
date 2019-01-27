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

Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
})

axios.defaults.baseURL = '/api/'
Vue.prototype.$axios = axios

new Vue({
    el: '#app',
    router: Vue.router,
    render: app => app(App)
})
