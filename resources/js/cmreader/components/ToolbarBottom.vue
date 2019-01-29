<template>
    <transition name="slide-down">
        <div class="toolbar header" v-show="isToolbarShow">
            <div class="back-button" v-on:click="goBack">
                <img 
                    class="back-button-img" 
                    src="/image/ui/back.png"
                />
            </div>
            <p class="chapter text"> {{ chapter }} </p>
            <p class="text">--</p>
            <p class="title text" v-bind:title="title"> {{ title }} </p>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        isToolbarShow: Boolean,
        chapter: String,
        title: String
    },
    methods: {
        goBack: function() {
            window.history.go(-1)
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

.back-button {
    cursor: pointer;
    height: 100%;
    padding: 1rem 1rem 1rem 0.5rem;
    box-sizing: border-box;
}

.back-button:hover {
    background-color: rgba(0, 0, 0, 0.25);
}

.back-button-img {
    width: 2rem;
    height: 2rem;
}

.text {
    color: #FFF;
    padding-right: 0.5rem;
}

.chapter {
    font-size: 1.5rem;
}

.title {
    font-size: 1rem;
    max-width: 8rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.slide-down-enter-active,
.slide-down-leave-active{
    transition: all 0.5s;
}

.slide-down-enter, 
.slide-down-leave-to {
    transform: translateY(-100%);
    opacity: 0;
}

</style>
