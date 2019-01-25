import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            components: {
                wrapper: Vue.component('Home', require('./components/Home.vue'))
            }
        },
        {
            path: '/SMH/books/:bid',
            name: 'smhbooks',
            components: {
                wrapper: Vue.component('SMHBooks', require('./components/BookDetail.vue'))
            },
            props: {
                wrapper: true
            }
        },
        {
            path: '/SMH/search/:searchText',
            name: 'search',
            components: {
                wrapper: Vue.component('SearchResult', require('./components/SearchResult.vue'))
            },
            props: {
                wrapper: true
            }
        }
    ]
})
