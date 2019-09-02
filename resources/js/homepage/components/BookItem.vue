<template>
    <div
        class="book-item"
        :class="isDetailed ? 'book-item-detailed': 'book-item-lite'"
        @click="goBookDetailPage()"
    >
        <img
            class="book-img"
            :class="isDetailed ? 'book-img-detailed': 'book-img-lite'"
            :src="'https://cf.hamreus.com/cpic/b/' + book.bid + '.jpg'"
        />
        <div
            class="book-info"
            :class="isDetailed ? 'book-info-detailed': 'book-info-lite'"
        >
            <p
                class="book-title text"
                :class="isDetailed ? 'book-title-detailed': 'book-title-lite'"
            >{{ book.name }}</p>
            <p
                v-show="isDetailed"
                class="book-author text"
            >{{ book.author == undefined ? '' : book.author.join() }}</p>
            <p
                v-show="isDetailed"
                class="book-status text"
            >{{ book.status == undefined ? '' :book.status }}</p>
            <p
                v-show="isDetailed"
                class="book-time text"
            >{{ book.update == undefined ? '' :book.update }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        book: Object,
        isDetailed: Boolean
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
    border-radius: 0.2rem;
    background-color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 0.4rem rgba(0, 0, 0, 0.4);
}

.book-item-lite {
    flex-direction: column;
    width: 8rem;
    height: 11rem;
    margin: 0.5rem;
}

.book-item-detailed {
    flex-direction: row;
    height: 6rem;
    width: 100%;
    margin: 0.25rem;
}

.book-img {
    object-fit: cover;
    flex-shrink: 0;
    border-top-left-radius: 0.2rem;
    border-top-right-radius: 0.2rem;
}

.book-img-lite {
    width: 8rem;
    height: 10rem;
    border-radius: 0.2rem 0.2rem 0 0;
}

.book-img-detailed {
    width: 4rem;
    height: 6rem;
    border-radius: 0.2rem 0 0 0.2rem;
}

.book-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
    box-sizing: border-box;
}

.book-info-lite {
    padding: 0rem 0.25rem;
}

.book-info-detailed {
    padding: 0.25rem 0.5rem;
}

.text {
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
}

.book-title {
    display: -webkit-box;
    -webkit-box-orient: vertical;
}

.book-title-lite {
    -webkit-line-clamp: 1;
    text-align: center;
    font-size: 0.8rem;
    font-weight: 400;
}

.book-title-detailed {
    -webkit-line-clamp: 2;
    text-align: left;
    font-size: 1rem;
    font-weight: 600;
    max-height: 2.3rem;
}

.book-author {
    font-size: 0.8rem;
    color: dimgrey;
    margin: 0;
}

.book-status {
    font-size: 0.8rem;
    color: red;
    margin: 0;
}

.book-time {
    font-size: 0.6rem;
    margin: 0;
}
</style>