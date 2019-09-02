<template>
    <div class="favo-wrapper">
        <book-group :bookGroup="bookGroup">
        </book-group>
    </div>
</template>

<script>
import BookGroup from './BookGroup.vue'

export default {
    components: {
        BookGroup
    },
    props: {
        userId: String
    },
    data: function () {
        return {
            bookGroup: {
                groupName: 'Favorites',
                books: []
            }
        }
    },
    created: function () {
        if (this.userId == '0')
            this.redircet()
    },
    mounted: function () {
        this.getFavoritesBooks();
    },
    methods: {
        redircet: function () {
            if (!this.$auth.check())
                this.$router.push({ name: 'login' })
            else
                this.$router.push({ name: 'favorites', params: { userId: this.$auth.user().id.toString() } })
        },
        getFavoritesBooks: function () {
            let _this = this
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            this.$axios.get(url).then(function (result) {
                _this.bookGroup.books = result.data
            })
        },
        updateFav: function () {
            for (let i = 0; i < this.bookGroup.books.length; ++i) {
                
            }
        }
    }
}
</script>

<style scoped>
.favo-wrapper {
    padding: 0;
    box-sizing: border-box;
}
</style>
