<template>
    <div
        class="book-wrapper"
        v-bind:class="{'book-menu-portrait' : isPortrait}"
    >
        <div
            class="book-info"
            v-bind:class="{'book-info-portrait' : isPortrait}"
        >
            <div class="book-func-wrapper">
                <img
                    class="book-cover"
                    v-bind:src="'https://cf.hamreus.com/cpic/b/' + bid + '.jpg'"
                >
                <div
                    class="fav-button"
                    v-on:click="changeFavorite"
                >
                    <img
                        class="fav-button-img"
                        src="/image/navbar/favorite.png"
                    >
                    <p class="fav-button-text">{{ favoriteInfo.isFavorite ? '取消收藏' : '添加收藏' }}</p>
                </div>
            </div>
            <div class="book-info-text">
                <h2 class="book-title">{{bookDetial.name}}</h2>
                <p class="book-intro">{{bookDetial.intro}}</p>
            </div>
        </div>
        <div class="split-block"></div>
        <div class="book-menu">
            <book-menu
                v-for="cateItem in bookDetial.dir"
                v-bind:key="cateItem.cateName"
                v-bind:bid="bookDetial.bid"
                v-bind:favoriteInfo="favoriteInfo"
                v-bind:menu="cateItem"
            ></book-menu>
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
    data: function () {
        return {
            isPortrait: false,
            bookDetial: {},
            favoriteInfo: {
                isFavorite: false,
                fid: '',
                lastChapter: 0
            }
        }
    },
    mounted: function () {
        this.getBookDetail()
        this.checkFavorite()
        this.setMenuPos()
    },
    methods: {
        getBookDetail: function () {
            var url = '/SMH/books/' + this.bid
            var _this = this
            this.$axios.get(url).then(function (result) {
                _this.bookDetial = result.data
            })
        },
        checkFavorite: function () {
            let _this = this
            if (!_this.$auth.check()) return
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            this.$axios({
                url: url,
                headers: {
                    Authorization: 'bearer ' + _this.$auth.token()
                }
            }).then(function (result) {
                for (let i = 0, len = result.data.length; i < len; ++i) {
                    if (result.data[i].bid == _this.bid) {
                        _this.favoriteInfo.isFavorite = true;
                        _this.favoriteInfo.fid = result.data[i].id;
                        _this.favoriteInfo.lastChapter =
                            result.data[i].lastChapter
                    }
                }
            })
        },
        changeFavorite: function () {
            let _this = this
            if (!_this.$auth.check()) _this.$router.push({ name: 'login' })
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            if (_this.favoriteInfo.isFavorite) {
                _this
                    .$axios({
                        method: 'DELETE',
                        url: url + '/' + _this.favoriteInfo.fid,
                        headers: {
                            Authorization: 'bearer ' + _this.$auth.token()
                        }
                    })
                    .then(function (res) {
                        _this.favoriteInfo.isFavorite = false;
                        _this.favoriteInfo.fid = undefined;
                    })
            } else {
                _this
                    .$axios({
                        method: 'POST',
                        url: url,
                        headers: {
                            Authorization: 'bearer ' + _this.$auth.token()
                        },
                        data: {
                            name: _this.bookDetial.name,
                            bid: _this.bookDetial.bid,
                            lastChapter: 0
                        }
                    })
                    .then(function (res) {
                        _this.favoriteInfo.isFavorite = true
                        _this.favoriteInfo.fid = res.data.data.id
                    })
            }
        },
        setMenuPos: function () {
            this.isPortrait = window.innerWidth < window.innerHeight
        }
    }
}
</script>

<style scoped>
.book-wrapper {
    display: flex;
    width: 100%;
    height: 100%;
    padding: 1rem;
    box-sizing: border-box;
}

.book-menu-portrait {
    flex-direction: row;
    flex-direction: column;
    align-items: center;
}

.book-info {
    display: flex;
    flex-shrink: 0;
    max-width: 100%;
    width: 24rem;
    height: 17rem;
    padding: 1rem;
    margin-bottom: 1rem;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 0.5rem;
    box-sizing: border-box;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
}

.book-info-portrait {
    width: 100%;
}

.book-func-wrapper {
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    width: 8rem;
    height: 100%;
    flex-shrink: 0;
}

.fav-button {
    cursor: pointer;
    background-color: rgb(127, 127, 127);
    height: 2rem;
    width: 100%;
    flex-shrink: 0;
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
    margin: 0 0 0 0.6rem;
    color: white;
}

.book-cover {
    width: 8rem;
    height: 12rem;
    flex-shrink: 0;
    object-fit: cover;
    border-radius: 0.2rem;
}

.book-info-text {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    padding: 0rem 1rem 0rem 1rem;
}

.book-title {
    margin: 0;
    font-size: 1rem;
}

.book-intro {
    font-size: 1rem;
    margin: 1rem 0 0 0;
    height: 11.5rem;
    overflow: hidden;
    text-overflow: ellipsis;
}

.split-block {
    width: 1rem;
    height: 1rem;
    flex-shrink: 0;
}

.book-menu {
    padding: 0;
    box-sizing: border-box;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
}
</style>
