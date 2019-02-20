<template>
    <div class="menu shadow" v-bind:class="{'menu-portrait': isPortrait}">
        <div
            class="cate-name"
            v-bind:class="{ 'bottom-radius-item' : !isExpend }"
            v-on:click="isExpend = !isExpend"
        >
            <p class="cate-name-text">{{menu.cateName}}</p>
        </div>
        <div
            class="cate-menu"
            v-show="isExpend"
        >
            <div
                class="chapter-item shadow"
                v-for="chapter in menu.cateMenu"
                v-bind:key="chapter.cid"
                v-on:click="goChapter(chapter.cid)"
                v-bind:class="{ 'have-read' : favoriteInfo.lastChapter == chapter.cid }"
            >
                <p
                    class="chapter-name"
                    v-bind:title="chapter.name"
                > {{chapter.name}} </p>
                <p class="chapter-page"> {{chapter.page + 'p'}} </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        bid: String,
        favoriteInfo: Object,
        menu: Object,
        isPortrait: Boolean
    },
    data: function () {
        return {
            isExpend: true
        };
    },
    methods: {
        goChapter: function (cid) {
            if (this.favoriteInfo.isFavorite) {
                this.$localStorage.set('cur_uid', this.$auth.user().id)
                this.$localStorage.set('cur_fid', this.favoriteInfo.fid)
                this.$localStorage.set('cur_bid', this.bid)
            }
            window.location.href = '/SMH/books/' + this.bid + '/chapters/' + cid
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
    background-color: rgba(255, 255, 255, 0.8);
}

.menu-portrait {
    border-radius: 0;
}

.cate-menu {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(9rem, 1fr));
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
    background-color: rgba(236, 236, 236, 0.8);
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
    background-color: rgba(255, 255, 255, 0.8);
    cursor: pointer;
}

.have-read {
    background-color: rgba(255, 228, 196, 0.8);
}

.chapter-name {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
