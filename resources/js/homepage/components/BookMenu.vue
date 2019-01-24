<template>
    <div class="menu">
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
                    class="chapter-item" 
                    v-for="chapter in menu.cateMenu" 
                    v-bind:key="chapter.cid"
                    v-on:click="goChapter(chapter.cid)"
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
        menu: {}
    },
    data: function() {
        return {
            isExpend: true
        };
    },
    methods: {
        goChapter: function(cid) {           
            window.location.href = '/SMH/books/' + this.bid + '/chapters/' + cid
        }
    }
};
</script>

<style scoped>
p {
    margin: 0rem;
}

.menu {
    width: 100%;
    border-radius: 0.5rem;
    background-color: rgba(192, 192, 192, 0.6);
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
    background-color: rgba(192, 192, 192, 0.6);
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
