import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import CmReader from './CmReader.vue';
import 'normalize.css'


Vue.use(VueAxios, axios)

Vue.prototype.$axios = axios

new Vue({
    el: '#app',
    render: app => app(CmReader)
})
