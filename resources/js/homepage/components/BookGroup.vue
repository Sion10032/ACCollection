<template>
    <transition-group class="book-group" name="book-group-load">
        <book-item
            v-for="book in this.bookGroup.books"
            v-bind:key="book.bid"
            v-bind:book="book"
            v-on:goBookDetailPage="goBookDetailPage"
        >
        </book-item>
    </transition-group>
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

.book-group-load-enter-active,
.book-group-load-leave-active {
    transition: all 0.5s;
}

.book-group-load-enter, 
.book-group-load-leave-to {
    transform: translateY(100%);
    opacity: 0;
}

.book-group-load-move {
    transition: transform 0.5s;
}

</style>
