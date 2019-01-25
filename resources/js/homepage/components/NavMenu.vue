<template>
    <div class="navbar">
        <ul class="nav-menu nav-menu-left">
            <li 
                is="nav-item"
                v-for="(navItem, index) in this.navItems"
                v-bind:key="index"
                v-bind:name="navItem.name"
                v-bind:icon="navItem.icon"
                v-bind:text="navItem.name"
                v-bind:selectedItem="selectedItem"
                v-bind:isNavItemTextShow="isNavItemTextShow"
                v-on:setSelectedItem="setSelectedItem"
            >
            </li>
        </ul>
        <ul class="nav-menu nav-menu-right">
            <li class="nav-item">
                <input class="search-bar" v-model="searchText" v-on:keyup.enter="search"/>
            </li>
            <li class="nav-item">
                <img class="avatar" />
            </li>
        </ul>
    </div>
</template>

<script>
import NavItem from './NavItem.vue'

export default {
    components: {
        NavItem
    },
    data() {
        return {
            isNavItemTextShow: false,
            selectedItem: 'Home',
            navItems: [
                {
                    name: 'Home',
                    icon: '/image/navbar/home.png'
                },
                {
                    name: 'Favorite',
                    icon: '/image/navbar/favorite.png'
                },
                {
                    name: 'Recent',
                    icon: '/image/navbar/recent.png'
                }
            ],
            searchText: ''
        }
    },
    mounted: function() {
        this.isNavItemTextShow = window.innerHeight < window.innerWidth
    },
    methods: {
        search: function() {
            this.$router.push({
                name: 'search', 
                params: { 
                    searchText: this.searchText 
                }
            })
            this.searchText = ''
        },
        setSelectedItem: function(selectedItem) {
            this.selectedItem = selectedItem
        }
    }
};
</script>

<style scoped>
.navbar {
    position:relative;
    height: 3rem;
    display: flex;
    align-items: Center;
    background-color: rgba(84, 92, 100, 0.8);;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.nav-menu {
    margin: 0rem;
    padding: 0rem;
    height: 100%;
    position: absolute;
    display: inline-flex;
    align-items: Center;
    list-style: none;
}

.nav-menu-left {
    margin-left: 0.5rem;
    left: 0rem;
}

.nav-menu-right {
    margin-right: 0.5rem;
    right: 0rem;
}

.search-bar {
    height: 1.5rem;
    width: 30vw;
    max-width: 12rem;
    padding-left: 0.5rem;
    border: 0rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.avatar {
    width: 2rem;
    height: 2rem;
    background-color: white;
    border-radius: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

</style>
