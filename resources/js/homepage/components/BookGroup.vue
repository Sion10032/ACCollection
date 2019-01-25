<template>
    <div class="book-group">
        <book-item
            v-for="book in this.bookGroup.books"
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
    props: {
        bookGroup: {
            groupName: String,
            books: Array
        }
    },
    methods: {
        goBookDetailPage: function(bookID) {
            this.$router.push({name: 'smhbooks', params: { bid: bookID }})
        }
    }
}
</script>

<style scoped>

.book-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(9rem, 1fr));
    grid-gap: 1rem;
}

</style>
