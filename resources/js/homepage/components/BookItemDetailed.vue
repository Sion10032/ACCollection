<template>
    <div
        class="book-item"
        v-on:click="goBookDetailPage()"
    >
        <img
            class="book-img"
            v-bind:src="'https://cf.hamreus.com/cpic/b/' + book.bid + '.jpg'"
        />
        <div class="book-info">
            <strong class="book-title text">{{ book.name }}</strong>
            <p class="book-author text">{{ book.author.join() }}</p>
            <p class="book-status text">{{ book.status[0] }}</p>
            <p class="book-time text">{{ book.status[1] }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        book: Object
    },
    methods: {
        goBookDetailPage: function () {
            this.$emit('goBookDetailPage', this.book.bid)
        }
    }
}
</script>

<style scoped>
.book-item {
    cursor: pointer;
    display: flex;
    width: 100%;
    height: 6rem;
    border-radius: 0.2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
    background: rgba(255, 255, 255, 0.8);
}

.book-img {
    width: 4rem;
    height: 6rem;
    flex-shrink: 0;
    object-fit: cover;
    border-radius: 0.2rem 0 0 0.2rem;
}

.book-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
    padding: 0.25rem 0.5rem;
    box-sizing: border-box;
}

.text {
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
}

.book-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    max-height: 2.3rem;
    font-size: 1rem;
}

.book-author {
    font-size: 0.8rem;
    color: dimgrey;
    margin: 0;
}

.book-status {
    font-size: 0.8rem;
    color: #F44336;
    margin: 0;
}

.book-time {
    font-size: 0.6rem;
    margin: 0;
}
</style>