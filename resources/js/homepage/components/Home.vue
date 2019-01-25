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
                groupName: 'hots',
                books: []
            }
        }
    },
    mounted: function() {
        this.getHotsBooks();
    },
    methods: {
        getHotsBooks: function() {
            var url = '/api/SMH/hots'
            var _this = this
            this.$axios.get(url).then(function(result) {
                _this.bookGroup.books = result.data
            })
        }
    }
}
</script>

<style scoped>

</style>
