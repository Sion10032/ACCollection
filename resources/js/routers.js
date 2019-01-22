import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter)

export default new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        components: {
            wrapper: Vue.component('Home', require('./components/Home.vue'))
        }
    }
    ]
})
