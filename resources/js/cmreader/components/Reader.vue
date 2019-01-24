<template>
    <div class="reader">
        <transition name="slide-down">
            <div class="toolbar header" v-show="isToolbarShow">
                <p class="chapter text"> {{ chapterData.chapter }} </p>
                <p class="title text" v-bind:title="chapterData.title"> {{ chapterData.title }} </p>
            </div>
        </transition>
        <div class="img-wrapper">
            <div class="mask">
                <div class="left" v-on:click="prevPage()"></div>
                <div class="center" v-on:click="isToolbarShow = !isToolbarShow"></div>
                <div class="right" v-on:click="nextPage()"></div>
            </div>
            <img 
                class="load-img"
                src="/image/loading.gif"
                v-show="isLoading"
            />
            <transition name="pic-appear">
                <img 
                    class="cm-img"
                    v-show="!isLoading"
                />
            </transition>
        </div>
        <transition name="slide-up">
            <div class="toolbar footer" v-show="isToolbarShow"></div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        chapterData: {}
    },
    data: function() {
        return {
            isLoading: true,
            isToolbarShow: true,
            cmImg: {},
            curPage: 0,
            imgs: []
        }
    },
    watch: {
        chapterData: function() {
            this.imgs = Array(this.chapterData.file.length)
            this.curPage = 1;
            this.loadPic()
        }
    },
    methods: {
        loadPic: function() {
            this.isLoading = true
            if (!this.imgs[this.curPage - 1])
                this.getPic(this.curPage - 1, true)
            else
                this.setImgSrc(this.curPage - 1)
            if (!this.imgs[this.curPage])
                this.getPic(this.curPage, false)
        },
        getPic: function(index, isSetImg) {
            let _this = this
            this.$axios.post('/api/SMH/getpic',
                {
                    'bid': this.chapterData.bid,
                    'cid': this.chapterData.cid,
                    'url': this.chapterData.file[index]
                }
            ).then(function(res) {
                _this.imgs[index] = res.data
                if (isSetImg)
                    _this.setImgSrc(index)
            });
        },
        setImgSrc: function(index) {
            this.isLoading = false
            let pic = document.getElementsByClassName('cm-img')[0]
            pic.src = this.imgs[index]
        },
        prevPage: function() {
            this.curPage = Math.max(0, this.curPage - 1)
            this.loadPic()
        },
        nextPage: function() {
            this.curPage = Math.min(this.chapterData.file.length, this.curPage + 1)
            this.loadPic()
        }
    }
}
</script>

<style scoped>

* {
    margin: 0;
}

.reader {
    background-color: #999999;
    width: 100%;
    height: 100%;
}

.mask {
    position: absolute;
    display: grid;
    grid-template-columns: 25% 50% 50%;
    top: 0;
    bottom: 0;
    z-index: 20;
    width: 100%;
    height: 100%;
}

.img-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.load-img {
    position: absolute;
    z-index: 10;
    width: 64px;
    height: 64px;
}

.cm-img {
    width: auto;
    height: 100%;
}

.toolbar {
    position: absolute;
    z-index: 30;
    background-color: #555555;
    width: 100%;
    height: 4rem;
}

.header {
    top: 0;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.text {
    color: #FFF;
}

.chapter {
    font-size: 1.5rem;
}

.title {
    font-size: 1rem;
    width: 8rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.footer {
    bottom: 0;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.25);
}

.slide-up-enter-active, 
.slide-down-enter-active, 
.pic-appear-enter-active,
.slide-up-leave-active, 
.slide-down-leave-active,
.pic-appear-leave-active {
    transition: all 0.3s;
}

.slide-up-enter, .slide-up-leave-to {
    transform: translateY(100%);
    opacity: 0;
}

.slide-down-enter, .slide-down-leave-to {
    transform: translateY(-100%);
    opacity: 0;
}

.pic-appear-enter, .pic-appear-leave-to {
    transform: translateY(0);
    opacity: 0;
}

</style>
