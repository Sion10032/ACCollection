import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import qs from 'qs';
import CmReader from './CmReader.vue';
import 'normalize.css'


Vue.use(VueAxios, axios)

axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8'
Vue.prototype.$axios = axios
Vue.prototype.$qs = qs;

new Vue({
    el: '#app',
    render: app => app(CmReader)
})
