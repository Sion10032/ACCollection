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
    data: function() {
        return {
            bookGroup: {
                groupName: 'Favorites',
                books: []
            }
        }
    },
    mounted: function() {
        this.getFavoritesBooks();
    },
    methods: {
        getFavoritesBooks: function() {
            let _this = this
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            this.$axios.get(url).then(function(result) {
                _this.bookGroup.books = result.data
            })
        }
    }
}
</script>

<style scoped>

</style>
