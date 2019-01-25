<template>
    <div class="book-wrapper">
        <div class="book-info">
            <img 
                class="book-cover"
                v-bind:src="'https://cf.hamreus.com/cpic/b/' + this.bid + '.jpg'" 
            />
            <div class="book-info-text">
                <h2 class="book-title"> {{bookDetial.name}} </h2>
                <p class="book-intro"> {{bookDetial.intro}} </p>
            </div>
        </div>
        <div class="book-menu">
            <book-menu 
                v-for="cateItem in bookDetial.dir"
                v-bind:key="cateItem.cateName"
                v-bind:menu="cateItem"
                v-bind:bid="bookDetial.bid"
            />
        </div>
    </div>
</template>

<script>
import BookMenu from './BookMenu.vue'

export default {
    components: {
        BookMenu
    },
    props: {
        bid: String
    },
    data: function() {
        return {
            bookDetial: {}
        }
    },
    mounted: function() {
        this.getBookDetail();
    },
    methods: {
        getBookDetail: function() {
            var url = '/api/SMH/books/' + this.bid
            var _this = this
            this.$axios.get(url).then(function(result) {
                _this.bookDetial = result.data
                _this.setMenuPos()
            })
        },
        setMenuPos: function() {
            var bookInfo = document.getElementsByClassName('book-info')[0]
            var bookMenu = document.getElementsByClassName('book-menu')[0]
            var bookWrapper = document.getElementsByClassName('book-wrapper')[0]
            if (bookInfo.offsetWidth < bookMenu.offsetWidth)
                bookWrapper.style['flex-direction'] = 'row'
            else{
                bookWrapper.style['flex-direction'] = 'column'
                bookWrapper.style['align-items'] = 'center'
            }
        }
    }
}
</script>

<style scoped>

.book-wrapper {
    display: flex;
    width: 100%;
    height: 100%;
}

.book-info {
    display: flex;
    flex-shrink: 0;
    width: 24rem;
    height: 16rem;
    padding: 1rem;
}

.book-cover {
    width: 8rem;
    height: 12rem;
    object-fit: cover;
    flex-shrink: 0;
    border-radius: 0.2rem;
}

.book-info-text {
    width: 100%;
    height: 100%;
    padding: 0rem 1rem 0rem 1rem;
}

.book-title {
    margin: 0rem;
}

.book-intro {
    overflow:hidden;
    text-overflow:ellipsis;
}

.book-menu {
    padding: 1rem;
    box-sizing: border-box;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
}

</style>
