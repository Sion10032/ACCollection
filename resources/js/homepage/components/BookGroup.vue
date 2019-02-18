<template>
    <transition-group
        class="book-group"
        v-bind:class="{'book-group-detailed': isDetailed}"
        name="book-group-load"
    >
        <book-item-lite
            v-for="book in bookGroup.books"
            v-bind:key="book.bid"
            v-bind:book="book"
            v-on:goBookDetailPage="goBookDetailPage"
        >
        </book-item-lite>
    </transition-group>
</template>

<script>
import BookItemDetailed from './BookItemDetailed.vue'
import BookItemLite from './BookItemLite.vue'

export default {
    components: {
        BookItemDetailed,
        BookItemLite
    },
    props: {
        bookGroup: {
            groupName: String,
            books: Array
        }
    },
    data: function () {
        return {
            isDetailed: false
        }
    },
    methods: {
        goBookDetailPage: function (bookID) {
            this.$router.push({ name: 'smhbooks', params: { bid: bookID } })
        }
    }
}
</script>

<style scoped>
.book-group {
    display: grid;
    justify-items: center;
    grid-template-columns: repeat(auto-fill, minmax(8rem, 1fr));
    grid-gap: 1rem;
}

.book-group-detailed {
    grid-template-columns: repeat(auto-fill, minmax(18rem, 1fr));
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
