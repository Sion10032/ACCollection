<template>
    <div class="reader">
        <img 
            class="load-img"
            src="/image/ui/loading.gif"
            v-if="!isGetData"
        />
        <toolbar-top
            v-if="isGetData"
            v-bind:isToolbarShow="isToolbarShow"
            v-bind:chapter="chapterData.chapter"
            v-bind:title="chapterData.title"
        >
        </toolbar-top>
        <div class="img-wrapper" v-if="isGetData">
            <div class="mask">
                <div class="left" v-on:click="isReverse ? prevPage() : nextPage()"></div>
                <div class="center" v-on:click="isToolbarShow = !isToolbarShow"></div>
                <div class="right" v-on:click="isReverse ? nextPage() : prevPage()"></div>
            </div>
            <img 
                class="load-img"
                src="/image/ui/loading.gif"
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
        <toolbar-bottom
            v-if="isGetData"
            v:bind:isReverse="isReverse"
            v-bind:isToolbarShow="isToolbarShow"
            v-bind:totalPage="chapterData.file.length"
            v-bind:curPage="curPage"
            v-on:changePage="changePage"
        >
        </toolbar-bottom>
    </div>
</template>

<script>
import ToolbarTop from './ToolbarTop.vue'
import ToolbarBottom from './ToolbarBottom.vue'

export default {
    components: {
        ToolbarTop,
        ToolbarBottom
    },
    props: {
        chapterData: Object
    },
    data: function() {
        return {
            isToolbarShow: true,
            isReverse: false,
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
        changePage: function(newPage) {
            this.curPage = newPage
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
    left: 50%;
    top: 50%;
    width: 64px;
    height: 64px;
}

.cm-img {
    position: absolute;
    height: 100%;
    object-fit: contain;
}

.pic-appear-enter-active, 
.pic-appear-leave-active {
    transition: all 0.5s;
}

.pic-appear-enter, 
.pic-appear-leave-to {
    opacity: 0;
}

</style>
