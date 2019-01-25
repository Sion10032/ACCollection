<template>
    <div class="home-wrapper">
        <book-group v-bind:bookGroup="this.bookGroup">
        </book-group>
    </div>
</template>

<script>
import BookGroup from './BookGroup.vue'

export default {
    components: {
        BookGroup
    },
    props: {
        searchText: String
    },
    data: function() {
        return {
            bookGroup: {
                groupName: 'SearchResult',
                books: []
            }
        }
    },
    watch: {
        searchText: function() {
            this.getSearchResult()
        }
    },
    mounted: function() {
        this.getSearchResult()
    },
    methods: {
        getSearchResult: function() {
            this.bookGroup.books = []
            let url = '/api/SMH/search/' + this.searchText
            this.$axios.get(url).then(
                res => {
                    this.bookGroup.books = res.data
                }
            );
        }
    }
}
</script>

<style scoped>

</style>
