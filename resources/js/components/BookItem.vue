<template>
    <div class="book-item">
        <img class="book-img" v-bind:src="'https://cf.hamreus.com/cpic/b/' + book.bid + '.jpg'"/>
        <a class="book-title">{{ book.name }}</a>
    </div>    
</template>

<script>
export default {
    props: {
        book: {
            name: String,
            bid: Number
        }
    }
}
</script>

<style scoped>

.book-item {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 9rem;
    height: 12rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.book-img {
    width: 9rem;
    height: 11rem;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.book-title {
    box-sizing: border-box;
    position: absolute;
    bottom: 0px;
    justify-content: center;
    text-align: center;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    padding: 0rem 0.5rem 0rem 0.5rem;
    width: 9rem;
    height: 1rem;
    font-size: 0.8rem;
}

</style>