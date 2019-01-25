<template>
    <div class="book-item" v-on:click="goBookDetailPage()">
        <img
            class="book-img" 
            v-bind:src="'https://cf.hamreus.com/cpic/b/' + book.bid + '.jpg'"
        />
        <a class="book-title">{{ book.name }}</a>
    </div>    
</template>

<script>
export default {
    props: {
        book: {
            name: String,
            bid: String
        }
    },
    methods: {
        goBookDetailPage: function() {
            this.$emit('goBookDetailPage', this.book.bid)
        }
    }
}
</script>

<style scoped>

.book-item {
    cursor:pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    width: 9rem;
    height: 12rem;
    border-radius: 0.2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.book-img {
    width: 9rem;
    height: 11rem;
    object-fit: cover;
    border-top-left-radius: 0.2rem;
    border-top-right-radius: 0.2rem;
}

.book-title {
    box-sizing: border-box;
    position: absolute;
    bottom: 0px;
    justify-content: center;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0rem 0.5rem 0rem 0.5rem;
    width: 9rem;
    height: 1rem;
    font-size: 0.8rem;
}

</style>