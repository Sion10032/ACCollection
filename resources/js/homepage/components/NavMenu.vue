<template>
    <div class="navbar">
        <ul class="nav-menu nav-menu-left">
            <li class="nav-item">
                <a class="nav-item-text">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-item-text">Favorite</a>
            </li>
            <li class="nav-item">
                <a class="nav-item-text">Recent</a>
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
export default {
    data() {
        return {
            searchText: ''
        }
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

.nav-item {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-items: center;
    height: 100%;
    padding: 0 0.5rem 0 0.5rem;
}

.nav-item:hover {
    background-color: rgba(72, 72, 72, 0.6);
}

.nav-item-text {
    font-size: 1rem;
    color: white;
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
