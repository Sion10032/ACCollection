<template>
    <div class="search-bar">
        <input
            class="search-input"
            v-model="searchText"
            @keyup.enter="search"
        />
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            searchText: ''
        }
    },
    methods: {
        search: function () {
            this.$router.push({
                name: 'search',
                params: {
                    searchText: this.searchText
                }
            })
            // this.searchText = ''
        }
    }

}
</script>

<style scoped>
/* .search-bar {
    
} */

.search-input {
    height: 1.5rem;
    width: 30vw;
    max-width: 12rem;
    padding-left: 0.5rem;
    border: 0;
    outline: none;
    border-radius: 0.75rem;
    /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25); */
}
</style>
