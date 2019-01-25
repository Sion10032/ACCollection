<template>
    <div class="navbar">
        <ul class="nav-menu nav-menu-left">
            <li 
                is="nav-item-slot"
                v-for="(navItem, index) in this.navItems"
                v-bind:key="index"
                v-bind:name="navItem.name"
                v-bind:selectedItem="selectedItem"
                v-on:setSelectedItem="setSelectedItem"
            >
                <nav-item 
                    v-bind:icon="navItem.icon"
                    v-bind:text="navItem.name"
                    v-bind:isNavItemTextShow="isNavItemTextShow"
                >
                </nav-item>
            </li>
        </ul>
        <ul class="nav-menu nav-menu-right">
            <li 
                is="nav-item-slot"
                v-bind:name="'SearchBar'"
                v-bind:selectedItem="selectedItem"
                v-on:setSelectedItem="preventSearchBarSelected"
            >
                <search-bar></search-bar>
            </li>
            <li 
                is="nav-item-slot"
                v-bind:name="'Avatar'"
                v-bind:selectedItem="selectedItem"
                v-on:setSelectedItem="setSelectedItem"
            >
                <img class="avatar" />
            </li>
        </ul>
    </div>
</template>

<script>
import NavItemSlot from './NavItemSlot.vue'
import NavItem from './NavItem.vue'
import SearchBar from './SearchBar.vue'

export default {
    components: {
        NavItem,
        NavItemSlot,
        SearchBar
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
            ]
        }
    },
    mounted: function() {
        this.isNavItemTextShow = window.innerHeight < window.innerWidth
    },
    methods: {
        setSelectedItem: function(selectedItem) {
            this.selectedItem = selectedItem
        },
        preventSearchBarSelected: function(selectedItem) {
            console.log('This is search bar.', selectedItem)
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


.avatar {
    width: 2rem;
    height: 2rem;
    background-color: white;
    border-radius: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

</style>
