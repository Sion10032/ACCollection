<template>
    <div class="book-group-wrapper">
        <!-- <div
            class="book-group-header"
            @click.self="isExpend = !isExpend"
        >
            <p class="text">{{ bookGroup.groupName }}</p>
            <button
                class="mode-switch"
                @click="isDetailed = !isDetailed"
            >
                <img
                    class="button-img"
                    :src="'/image/ui/button-mode-' + (isDetailed ? 'detailed.png' : 'lite.png')"
                />
            </button>
        </div> -->
        <transition-group
            tag="div"
            v-show="isExpend"
            class="book-group"
            :class="isDetailed ? 'book-group-detailed': 'book-group-lite'"
            name="book-group-load"
        >
            <book-item
                v-for="book in bookGroup.books"
                :key="book.bid"
                :book="book"
                :isDetailed="isDetailed"
                @goBookDetailPage="goBookDetailPage"
            >
            </book-item>
        </transition-group>
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
    data: function () {
        return {
            activeName: '1',
            isExpend: true,
            isDetailed: true
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
.book-group-wrapper {
    width: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.book-group-header {
    cursor: pointer;
    background-color: #5a7a8f;
    height: 2rem;
    padding: 0 0.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.text {
    margin: 0;
    font-size: 1rem;
    color: #ffffff;
}

.mode-switch {
    cursor: pointer;
    border: none;
    background: none;
    outline: none;
    padding: 0;
    width: 2rem;
    height: 2rem;
}

.button-img {
    width: 1rem;
    height: 1rem;
}

.book-group {
    display: grid;
    justify-items: center;
    background-color: white;
    box-sizing: border-box;
}

.book-group-lite {
    padding: 0.5rem;
    grid-template-columns: repeat(auto-fill, minmax(8rem, 1fr));
    grid-gap: 0.5rem;
}

.book-group-detailed {
    padding: 0.25rem;
    grid-template-columns: repeat(auto-fill, minmax(18rem, 1fr));
    grid-gap: 0.25rem;
}

.book-group-load-enter-active,
.book-group-load-leave-active {
    transition: all 1s;
}

.book-group-load-enter,
.book-group-load-leave-to {
    transform: translateY(100%);
    opacity: 0;
}
</style>
