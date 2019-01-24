<template>
    <div class="book-res">
        <book-item
            v-for="book in books"
            v-bind:key="book.bid"
            v-bind:book="book"
            v-on:goBookDetailPage="goBookDetailPage"
        >
        </book-item>
    </div>
</template>

<script>
import BookItem from './BookItem.vue'

export default {
    components: {
        BookItem
    },
    data: function() {
        return {
            books: {}
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
                _this.books = result.data
            })
        },
        goBookDetailPage: function(bookID) {
            this.$router.push({name: 'smhbooks', params: { bid: bookID }})
        }
    }
}
</script>

<style scoped>

.book-res {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(9rem, 1fr));
    grid-gap: 1rem;
}

</style>
