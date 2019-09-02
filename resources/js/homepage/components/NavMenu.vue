<template>
    <div class="navbar">
        <ul class="nav-menu nav-menu-left">
            <li
                is="nav-item-slot"
                v-for="(navItem, index) in navItems"
                :key="index"
                :name="navItem.name"
                :selectedItem="selectedItem"
                @setSelectedItem="setSelectedItem"
            >
                <nav-item
                    :infos="navItem"
                    :isNavItemTextShow="isNavItemTextShow"
                >
                </nav-item>
            </li>
            <!-- <li
                class="fresh-button"
                @click="freshClick"
            >
                <img
                    class="fresh-button-icon"
                    src="/image/navbar/fresh.png"
                />
            </li> -->
        </ul>
        <ul class="nav-menu nav-menu-right">
            <li
                is="nav-item-slot"
                :name="'SearchBar'"
                :selectedItem="selectedItem"
                @setSelectedItem="preventSearchBarSelected"
            >
                <search-bar></search-bar>
            </li>
            <li
                is="nav-item-slot"
                :name="'Avatar'"
                :selectedItem="selectedItem"
                @setSelectedItem="setSelectedItem"
            >
                <nav-avatar></nav-avatar>
            </li>
        </ul>
    </div>
</template>

<script>
import NavItemSlot from './NavItemSlot.vue'
import NavItem from './NavItem.vue'
import SearchBar from './SearchBar.vue'
import NavAvatar from './NavAvatar.vue'

export default {
    components: {
        NavItem,
        NavItemSlot,
        SearchBar,
        NavAvatar
    },
    data() {
        return {
            freshClickTimes: 0,
            isNavItemTextShow: false,
            selectedItem: 'Home',
            navItems: [
                {
                    name: 'Home',
                    icon: '/image/navbar/home.png',
                    router: 'home',
                    params: {}
                },
                {
                    name: 'Favorite',
                    icon: '/image/navbar/favorite.png',
                    router: 'favorites',
                    params: {
                        userId: '0'
                    }
                },
                // {
                //     name: 'Recent',
                //     icon: '/image/navbar/recent.png',
                //     router: '',
                //     params: {}
                // }
            ]
        }
    },
    mounted: function () {
        this.isNavItemTextShow = window.innerHeight < window.innerWidth
    },
    methods: {
        setSelectedItem: function (selectedItem) {
            this.selectedItem = selectedItem
        },
        preventSearchBarSelected: function (selectedItem) {
            console.log('This is search bar.', selectedItem)
        },
        // freshClick: function () {
        //     if (++this.freshClickTimes > 2) {
        //         this.freshClickTimes = 0
        //         this.$axios.get('/resources/fresh').then(
        //             () => alert('后台更新资源成功')
        //         );
        //     }
        //     else {
        //         let s = '再点击' + (3 - this.freshClickTimes) + '次则更新后台资源。'
        //         alert(s)
        //     }
        // }
    }
};
</script>

<style scoped>
.navbar {
    height: 3rem;
    display: flex;
    justify-content: space-between;
    align-items: Center;
    background-color: #607d8b;
    box-shadow: 0 -0.2rem 0.2rem rgba(0, 0, 0, 0.5);
}

.nav-menu {
    margin: 0rem;
    padding: 0rem;
    height: 100%;
    display: inline-flex;
    align-items: Center;
    list-style: none;
}

.nav-menu-left {
    margin-left: 0.5rem;
}

.nav-menu-right {
    margin-right: 0.5rem;
}

.fresh-button {
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
    justify-items: center;
    padding: 0 0.5rem 0 0.5rem;
}

.fresh-button:hover {
    background-color: rgba(0, 0, 0, 0.4);
}

.fresh-button-icon {
    height: 60%;
    margin: 0.25rem;
    flex-shrink: 0;
}
</style>
