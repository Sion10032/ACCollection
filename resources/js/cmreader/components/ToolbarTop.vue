<template>
    <transition name="slide-down">
        <div
            class="toolbar header"
            v-show="isToolbarShow"
        >
            <div
                class="button-wrapper"
                @click="goBack"
            >
                <img
                    class="button-img"
                    src="/image/ui/back.png"
                />
            </div>
            <span class="title-wrapper">
                <p class="chapter text"> {{ chapter }}</p>
                <p
                    class="title text"
                    :title="title"
                >{{ title }} </p>
            </span>
            <div
                class="button-wrapper"
                @click="$emit('reload')"
            >
                <img
                    class="button-img"
                    src="/image/ui/refresh.png"
                />
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        isToolbarShow: Boolean,
        chapter: String,
        title: String,
        bid: String
    },
    methods: {
        goBack: function () {
            window.location.href = '/#/SMH/books/' + this.bid
        }
    }
}
</script>

<style scoped>
.toolbar {
    position: absolute;
    z-index: 30;
    background-color: #555555;
    width: 100%;
    height: 4rem;
}

.header {
    top: 0;
    padding: 0;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
}

.button-wrapper {
    cursor: pointer;
    height: 100%;
    padding: 1rem 1rem 1rem 1rem;
    box-sizing: border-box;
}

.button-wrapper:hover {
    background-color: rgba(0, 0, 0, 0.25);
}

.button-img {
    width: 2rem;
    height: 2rem;
}

.title-wrapper {
    width: calc(100% - 8rem);
}

.text {
    margin: 0;
    color: #fff;
}

.chapter {
    font-size: 1.5rem;
}

.title {
    font-size: 1rem;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.slide-down-enter-active,
.slide-down-leave-active {
    transition: all 0.5s;
}

.slide-down-enter,
.slide-down-leave-to {
    transform: translateY(-100%);
    opacity: 0;
}
</style>
