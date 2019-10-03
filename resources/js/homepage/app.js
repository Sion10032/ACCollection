import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueLocalStorage from 'vue-localstorage';
import VueAuth from '@websanova/vue-auth';
import VueAuthAuth from '@websanova/vue-auth/drivers/auth/bearer.js';
import VueAuthHttp from '@websanova/vue-auth/drivers/http/axios.1.x.js';
import VueAuthRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x.js';
import Vant from 'vant';
import 'vant/lib/index.css';
import App from './App.vue';
import router from './routers.js';
import 'normalize.css';

Vue.use(VueAxios, axios);
Vue.use(VueLocalStorage);

Vue.router = router;
Vue.use(VueAuth, {
    auth: VueAuthAuth,
    http: VueAuthHttp,
    router: VueAuthRouter
});

Vue.use(Vant);

axios.defaults.baseURL = '/api/';
Vue.prototype.$axios = axios;

new Vue({
    el: '#app',
    router: Vue.router,
    render: app => app(App)
});
