<template>
    <div id="acc" v-if="$auth.ready()">
        <div id="scroll-view" class="scrollbar" v-on:scroll.passive="onScroll">
            <transition name="router-trans">
                <router-view name="wrapper" style="width: 100vw;"></router-view>
            </transition>
        </div>
        <transition name="slide-down">
            <nav-menu id="nav" v-show="this.isNavShow"></nav-menu>
        </transition>
    </div>
</template>

<script>
import NavMenu from "./components/NavMenu.vue";

export default {
    components: {
        NavMenu
    },
    data: function() {
        return {
            lastPos: 0,
            isNavShow: true
        };
    },
    methods: {
        onScroll: function($event) {
            // console.log("onScroll", this.lastPos);
            this.isNavShow = this.lastPos > $event.target.scrollTop;
            this.lastPos = $event.target.scrollTop;
        }
    }
};

document.addEventListener("DOMContentLoaded", () => {
    const html = document.querySelector("html");
    html.style.fontSize = window.innerHeight / 50 + "px";
});
</script>

<style scoped>
#acc {
    /* display: flex;
    flex-direction: column; */
    position: relative;
    width: 100%;
    height: 100%;
    background-image: url(/image/background-yuki.jpg);
    /* background-size: cover; */
    background-repeat: repeat;
}

#nav {
    position: absolute;
    bottom: 0;
    width: 100%;
}

#scroll-view {
    width: 100%;
    height: 100%;
    overflow-y: scroll;
    overflow-x: hidden;
}

.scrollbar::-webkit-scrollbar {
    display: none;
    width: 6px;
}

.scrollbar::-webkit-scrollbar-thumb {
    border-radius: 6px;
    width: 6px;
    background: rgba(0, 0, 0, 0.25);
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
}

.slide-down-enter-active,
.slide-down-leave-active {
    transition: all 0.5s;
}

.slide-down-enter,
.slide-down-leave-to {
    transform: translateY(100%);
    opacity: 0;
}

.router-trans-enter-active， .router-trans-leave-active {
    transition: all 0.5s;
}

.router-trans-enter,
.router-trans-leave-to {
    opacity: 0;
}
</style>
