<template>
    <div class="reader">
        <transition name="slide-down">
            <div class="toolbar header" v-show="isToolbarShow">
                <p class="chapter text"> {{ chapterData.chapter }} </p>
                <p class="title text" v-bind:title="chapterData.title"> {{ chapterData.title }} </p>
            </div>
        </transition>
        <div class="img-wrapper" v-if="this.isGetData">
            <div class="mask">
                <div class="left" v-on:click="prevPage()"></div>
                <div class="center" v-on:click="isToolbarShow = !isToolbarShow"></div>
                <div class="right" v-on:click="nextPage()"></div>
            </div>
            <img 
                class="load-img"
                src="/image/loading.gif"
                v-show="this.imgs[this.curPage].Loading"
            />
            <transition-group name="pic-appear">
                <img
                    class="cm-img"
                    v-for="img in this.imgs"
                    v-bind:key="img.page"
                    v-show="!img.Loading && (img.page == curPage)"
                    v-bind:src="img.data"
                />
            </transition-group>
        </div>
        <transition name="slide-up">
            <div class="toolbar footer" v-show="isToolbarShow"></div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        chapterData: Object
    },
    data: function() {
        return {
            isToolbarShow: true,
            isGetData: false,
            isPreLoad: true,
            cmImg: {},
            curPage: -1,
            imgs: []
        }
    },
    watch: {
        chapterData: function() {
            this.imgs = []
            for (let i = 0; i < this.chapterData.file.length; ++i)
                this.imgs.push({page: i,Loading: false, data: ''})
            this.curPage = 0
            this.isGetData = true
        },
        curPage: function() {
            console.log('Page Change:', this.curPage)
            this.loadPic()
        }
    },
    methods: {
        loadPic: function() {
            if (
                !this.imgs[this.curPage].data && 
                !this.imgs[this.curPage].Loading
            )
                this.getPic(this.curPage)
            if (this.isPreLoad) {
                if (this.curPage == this.chapterData.file.length - 1)
                    return
                else {
                    if (
                        this.imgs[this.curPage + 1].data == '' && 
                        this.imgs[this.curPage + 1].Loading == false
                    )
                        this.getPic(this.curPage + 1)
                }
            }
        },
        getPic: function(index) {
            console.log('Get Img', index, 'from network.')
            let _this = this
            _this.imgs[index].Loading = true
            _this.$axios.post('/SMH/getpic',
                {
                    'bid': _this.chapterData.bid,
                    'cid': _this.chapterData.cid,
                    'url': _this.chapterData.file[index]
                }
            ).then(function(res) {
                _this.imgs[index].data = res.data
                _this.imgs[index].Loading = false
                console.log('Get Img', index, 'from network success.')
            }).catch(function(error) {
                _this.imgs[index].Loading = false
            });
        },
        prevPage: function() {
            console.log('prev')
            this.curPage = Math.max(0, this.curPage - 1)
        },
        nextPage: function() {
            console.log('next')
            this.curPage = Math.min(this.chapterData.file.length - 1, this.curPage + 1)
        }
    }
}

</script>

<style scoped>

* {
    margin: 0;
}

span {
    display: contents;
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
    z-index: 15;
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
    position: absolute;
    height: 100%;
    object-fit: contain;
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
    padding: 0 1rem 0 1rem;
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
    transition: all 0.5s;
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
    opacity: 0;
}

</style>
