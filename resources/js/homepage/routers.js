import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './components/Home.vue'
import BookDetail from './components/BookDetail.vue'
import SearchResult from './components/SearchResult.vue'
import Profile from './components/Profile.vue'
import Favorite from './components/Favorite.vue'
import AuthLoginPage from './components/AuthLoginPage.vue'
import AuthRegisterPage from './components/AuthRegisterPage.vue'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            components: { wrapper: Vue.component('Home', Home) }
        },
        {
            path: '/SMH/books/:bid',
            name: 'smhbooks',
            components: { wrapper: Vue.component('SMHBooks', BookDetail) },
            props: { wrapper: true }
        },
        {
            path: '/SMH/search/:searchText',
            name: 'search',
            components: { wrapper: Vue.component('SearchResult', SearchResult) },
            props: { wrapper: true }
        },
        {
            path: '/users/:userId',
            name: 'user',
            components: { wrapper: Vue.component('UserProfile', Profile) },
            props: { wrapper: true }
        },
        {
            path: '/users/:userId/favorites',
            name: 'favorites',
            components: { wrapper: Vue.component('Favorite', Favorite) },
            props: { wrapper: true }
        },
        {
            path: '/auth/login',
            name: 'login',
            components: { wrapper: Vue.component('LoginPage', AuthLoginPage) }
        },
        {
            path: '/auth/register',
            name: 'register',
            components: { wrapper: Vue.component('RegisterPage', AuthRegisterPage) }
        }
    ]
})
