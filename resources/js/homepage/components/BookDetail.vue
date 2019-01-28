<template>
    <div class="book-wrapper">
        <div class="book-info">
            <div class="book-func-wrapper">
                <img 
                    class="book-cover"
                    v-bind:src="'https://cf.hamreus.com/cpic/b/' + this.bid + '.jpg'" 
                />
                <div class="fav-button" v-on:click="changeFavorite">
                    <img class="fav-button-img" src="/image/navbar/favorite.png" />
                    <p class="fav-button-text"> {{ this.favoriteInfo.isFavorite ? '取消收藏' : '添加收藏' }} </p>
                </div>
            </div>
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
            bookDetial: {},
            favoriteInfo: {
                isFavorite: false,
                fid: String
            }
        }
    },
    mounted: function() {
        this.getBookDetail();
        this.checkFavorite();        
        this.setMenuPos()
    },
    methods: {
        getBookDetail: function() {
            var url = '/SMH/books/' + this.bid
            var _this = this
            this.$axios.get(url).then(function(result) {
                _this.bookDetial = result.data
            })
        },
        checkFavorite: function() {
            let _this = this
            if (!_this.$auth.check())
                return
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            this.$axios({
                url: url,
                headers: {
                    'Authorization': 'bearer ' + _this.$auth.token()
                }
            }).then(function(result) {
                for(let i = 0, len = result.data.length; i < len; ++i) {
                    if (result.data[i].bid == _this.bid) {
                        _this.favoriteInfo.isFavorite = true
                        _this.favoriteInfo.fid = result.data[i].id
                    }
                }
            })
        },
        changeFavorite: function() {
            let _this = this
            if (!_this.$auth.check())
                _this.$router.push({name: 'login'})
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            if (_this.favoriteInfo.isFavorite) {
                _this.$axios({
                    method: "DELETE",
                    url: url + '/' + _this.favoriteInfo.fid,
                    headers: {
                        'Authorization': 'bearer ' + _this.$auth.token()
                    }
                }).then(function(res) {
                    console.log(res.data);
                    _this.favoriteInfo.isFavorite = false
                });
            }
            else {
                _this.$axios({
                    method: "POST",
                    url: url,
                    headers: {
                        'Authorization': 'bearer ' + _this.$auth.token()
                    },
                    data: {
                        name: _this.bookDetial.name,
                        bid: _this.bookDetial.bid,
                        lastChapter: 0
                    }
                }).then(function(res) {
                    console.log(res.data);
                    _this.checkFavorite()
                });
            }
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
    margin-bottom: 1rem;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 0.5rem;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
}

.book-func-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 8rem;
    height: 100%;
    flex-shrink: 0;
}

.fav-button {
    cursor: pointer;
    background-color: rgb(127, 127, 127);
    height: 2rem;
    width: 100%;
    margin-top: 0.5rem;
    padding: 0;
    border-radius: 1rem;
    display: inline-flex;
    align-items: center;
}

.fav-button:hover {
    background-color: rgb(255, 0, 0);
}

.fav-button-img {
    height: 2rem;
    width: 2rem;
    flex-shrink: 0;
}

.fav-button-text {
    margin-left: 0.6rem;
    color: white;
} 

.book-cover {
    width: 8rem;
    height: 12rem;
    object-fit: cover;
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
    padding: 0 1rem;
    box-sizing: border-box;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
}

</style>
