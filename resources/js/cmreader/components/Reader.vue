<template>
    <div class="reader">
        <img
            class="load-img"
            src="/image/ui/loading.gif"
            v-if="!isGetData"
        />
        <toolbar-top
            v-if="isGetData"
            :isToolbarShow="isToolbarShow"
            :chapter="chapterData.chapter"
            :title="chapterData.title"
            :bid="chapterData.bid"
        >
        </toolbar-top>
        <div
            class="img-wrapper"
            v-if="isGetData"
        >
            <transition name="pic-appear">
                <settings
                    v-show="isSettingsShow"
                    @updateSettings="updateSettings"
                    @showSettings="showSettings"
                >
                </settings>
            </transition>
            <div class="mask">
                <div
                    class="left"
                    @click="isReverse ? prevPage() : nextPage()"
                ></div>
                <div
                    class="center"
                    @click="isToolbarShow = !isToolbarShow"
                ></div>
                <div
                    class="right"
                    @click="isReverse ? nextPage() : prevPage()"
                ></div>
            </div>
            <transition-group name="pic-appear">
                <img
                    class="cm-img"
                    v-for="(img, index) in this.chapterData.files"
                    :key="index"
                    v-show="index == curPage"
                    :src="img"
                />
            </transition-group>
        </div>
        <toolbar-bottom
            v-if="isGetData"
            :isReverse="isReverse"
            :isToolbarShow="isToolbarShow"
            :totalPage="chapterData.files.length"
            :curPage="curPage"
            @changePage="changePage"
            @showSettings="showSettings"
        >
        </toolbar-bottom>
    </div>
</template>

<script>
import ToolbarTop from './ToolbarTop.vue'
import ToolbarBottom from './ToolbarBottom.vue'
import Settings from './Settings.vue'

export default {
    components: {
        ToolbarTop,
        ToolbarBottom,
        Settings
    },
    props: {
        chapterData: Object
    },
    data: function () {
        return {
            isToolbarShow: true,
            isSettingsShow: false,
            isJump: false,
            isGetData: false,
            isReverse: false,
            isCheck: true,
            isPreLoad: true,
            curPage: -1
        }
    },
    watch: {
        chapterData: function () {
            this.curPage = 0
            this.isGetData = true
        },
        curPage: function () {
            console.log('Page Change:', this.curPage)
        }
    },
    methods: {
        changePage: function (newPage) {
            this.curPage = newPage
        },
        prevPage: function () {
            console.log('prev')
            if (this.curPage == 0) {
                if (this.isCheck) {
                    if (this.isJump) {
                        this.isJump = false
                        this.$emit('goPrevChapter')
                    }
                    else
                        this.isJump = true
                }
                else {
                    this.isJump = false
                    this.$emit('goPrevChapter')
                }
            }
            else
                this.isJump = false
            this.curPage = Math.max(0, this.curPage - 1)
        },
        nextPage: function () {
            console.log('next')
            if (this.curPage == this.chapterData.files.length - 1) {
                if (this.isCheck) {
                    if (this.isJump) {
                        this.isJump = false
                        this.$emit('goNextChapter')
                    }
                    else
                        this.isJump = true
                }
                else {
                    this.isJump = false
                    this.$emit('goNextChapter')
                }
            }
            else
                this.isJump = false
            this.curPage = Math.min(this.chapterData.files.length - 1, this.curPage + 1)
        },
        updateSettings: function (isReverse, isCheck, isPreLoad) {
            this.isReverse = isReverse
            this.isCheck = isCheck
            this.isPreLoad = isPreLoad
        },
        showSettings: function () {
            this.isSettingsShow = !this.isSettingsShow
        }
    }
}

</script>

<style scoped>
* {
    margin: 0;
}

span {
    position: relative;
    width: 100%;
    height: 100%;
}

.reader {
    background-color: #999999;
    width: 100%;
    height: 100%;
}

.mask {
    position: absolute;
    display: flex;
    top: 0;
    bottom: 0;
    z-index: 20;
    width: 100%;
    height: 100%;
}

.left {
    height: 100%;
    flex-grow: 3;
}

.center {
    height: 100%;
    flex-grow: 4;
}

.right {
    height: 100%;
    flex-grow: 3;
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
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    width: 4rem;
    height: 4rem;
}

.cm-img {
    position: absolute;
    object-fit: contain;
    width: 100%;
    height: 100%;
}

.pic-appear-enter-active,
.pic-appear-leave-active {
    transition: all 0.3s;
}

.pic-appear-enter,
.pic-appear-leave-to {
    opacity: 0;
}
</style>
