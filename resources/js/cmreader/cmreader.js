import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import qs from 'qs';
import CmReader from './CmReader.vue';
import 'normalize.css'


Vue.use(VueAxios, axios)

axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8'
axios.defaults.baseURL = '/api/'
Vue.prototype.$axios = axios

new Vue({
    el: '#app',
    render: app => app(CmReader)
})
