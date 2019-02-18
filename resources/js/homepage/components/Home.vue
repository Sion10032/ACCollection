<template>
    <div class="home-wrapper">
        <book-group v-bind:bookGroup="bookGroup">
        </book-group>
    </div>
</template>

<script>
import BookGroup from './BookGroup.vue'

export default {
    components: {
        BookGroup
    },
    data: function () {
        return {
            bookGroup: {
                groupName: 'Hots',
                books: []
            }
        }
    },
    mounted: function () {
        this.getHotsBooks();
    },
    methods: {
        getHotsBooks: function () {
            var _this = this
            this.$axios.get('/SMH/hots').then(function (result) {
                _this.bookGroup.books = result.data
            })
        }
    }
}
</script>

<style scoped>
.home-wrapper {
    padding: 1rem;
    box-sizing: border-box;
}
</style>
