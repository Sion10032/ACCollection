<template>
    <div class="menu shadow">
        <div
            class="cate-name"
            v-bind:class="{ 'bottom-radius-item' : !isExpend }"
            v-on:click="isExpend = !isExpend"
        >
            <p class="cate-name-text">{{menu.cateName}}</p>
        </div>
        <transition name="slider">
            <div class="cate-menu" v-show="isExpend">
                <div 
                    class="chapter-item shadow" 
                    v-for="chapter in menu.cateMenu" 
                    v-bind:key="chapter.cid"
                    v-on:click="goChapter(chapter.cid)"
                    v-bind:class="{ 'have-read' : favoriteInfo.lastChapter == chapter.cid }"
                >
                    <p class="chapter-name" v-bind:title="chapter.name"> {{chapter.name}} </p>
                    <p class="chapter-page"> {{chapter.page + 'p'}} </p>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        bid: String,
        favoriteInfo: Object,
        menu: Object
    },
    data: function() {
        return {
            isExpend: true
        };
    },
    methods: {
        goChapter: function(cid) {
            let _this = this
            let url = '/users/' + _this.$auth.user().id + '/favorites'
            if (_this.favoriteInfo.isFavorite) {
                _this.$axios({
                    method: "PUT",
                    url: url + '/' + _this.favoriteInfo.fid,
                    headers: {
                        'Authorization': 'bearer ' + _this.$auth.token()
                    },
                    data: {
                        lastChapter: cid
                    }
                }).then(function(res) {
                    // console.log('update success.', res.data, _this)
                    window.location.href = '/SMH/books/' + _this.bid + '/chapters/' + cid
                }).catch(function() {
                    window.location.href = '/SMH/books/' + _this.bid + '/chapters/' + cid
                });
            }     
        }
    }
};
</script>

<style scoped>
p {
    margin: 0rem;
}

.shadow {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
}

.menu {
    width: 100%;
    border-radius: 0.5rem;
    background-color: rgba(255, 255, 255, 0.6);    
    margin-bottom: 1rem;
}

.cate-menu {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(9rem, 1fr));
    grid-gap: 1rem;
    padding: 0.5rem;
}

.cate-name {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 2rem;
    padding: 0 1rem 0 1rem;
    background-color: rgba(236, 236, 236, 0.6);
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
    box-sizing: border-box;
    cursor: pointer;
}

.bottom-radius-item {
    border-bottom-left-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

.chapter-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 1.5rem;
    padding: 0 0.5rem 0 0.5rem;
    border-radius: 0.2rem;
    background-color: rgba(255, 255, 255, 0.6);
    cursor: pointer;
}

.have-read {
    background-color: rgba(255, 228, 196, 0.6);
}

.chapter-name {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.slider-enter-active {
    transition: all 0.3s;
}

.slider-leave-active {
    transition: all 0.3s;
}

.slider-enter, .slider-leave-to {
    transform-origin: center 0 0;
    transform: scaleY(0);
    opacity: 0;
}
</style>
