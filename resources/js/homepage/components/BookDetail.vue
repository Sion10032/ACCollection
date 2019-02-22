<template>
    <div class="book-detail-wrapper">
        <div class="book-title-wrapper">
            <h2 class="book-title">{{ bookDetial.name }}</h2>
        </div>
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
                <div class="book-info-text-wrapper">
                    <p class="book-info-text">
                        <span>作者：</span>
                        <span class="book-author">{{ bookDetial.author.join(',') }}</span>
                    </p>
                    <p class="book-info-text">
                        <span>连载状态：</span>
                        <span class="book-status">{{ bookDetial.status }}</span>
                    </p>
                    <p class="book-info-text">
                        <span>更新时间：</span>
                        <span class="book-update">{{ bookDetial.update }}</span>
                    </p>
                    <p class="book-info-text book-intro">
                        <span>简介：</span>
                        <span>{{ bookDetial.intro }}</span>
                    </p>
                </div>
            </div>
            <div class="split-block"></div>
            <div class="book-menu-group">
                <book-menu
                    class="book-menu"
                    v-for="cateItem in bookDetial.dir"
                    v-bind:key="cateItem.cateName"
                    v-bind:bid="bookDetial.bid"
                    v-bind:favoriteInfo="favoriteInfo"
                    v-bind:menu="cateItem"
                    v-bind:isPortrait="isPortrait"
                ></book-menu>
            </div>
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
                            author: _this.bookDetial.author,
                            status: _this.bookDetial.status,
                            update: _this.bookDetial.update,
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
.book-detail-wrapper {
    width: 100%;
    height: 100%;
}

.book-title-wrapper {
    width: 100%;
    height: 2.5rem;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
    padding: 0 1rem;
    box-sizing: border-box;
}

.book-title {
    margin: 0;
    font-size: 1.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

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
    padding: 0.5rem 0;
}

.book-info {
    display: flex;
    flex-shrink: 0;
    max-width: 100%;
    width: 30rem;
    height: fit-content;
    padding: 1rem;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 0.5rem;
    box-sizing: border-box;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
}

.book-info-portrait {
    width: 100%;
    border-radius: 0;
}

.book-func-wrapper {
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    width: 8rem;
    height: 100%;
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

.book-info-text-wrapper {
    /* flex-grow: 1; */
    display: flex;
    flex-direction: column;
    width: 100%;
    /* height: 100%; */
    padding: 0rem 1rem 0rem 1rem;
}

.book-info-text {
    padding: 0;
    margin: 0;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.book-author {
    color: dimgrey;
}

.book-status {
    color: red;
}

.book-update {
    color: orange;
}

.book-intro {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;
}

.split-block {
    width: 1rem;
    height: 0.5rem;
    flex-shrink: 0;
}

.book-menu-group {
    padding: 0;
    box-sizing: border-box;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
}

.book-menu {
    margin-bottom: 0.5rem;
}
</style>
