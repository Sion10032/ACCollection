<template>
    <div id="acc" v-if="$auth.ready()">
        <div id="scroll-view" class="scrollbar">
            <transition name="router-trans">
                <router-view name="wrapper" style="width: 100vw;"></router-view>
            </transition>
        </div>
        <nav-menu id="nav"></nav-menu>
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
        };
    },
    methods: {
    }
};

document.addEventListener("DOMContentLoaded", () => {
    const html = document.querySelector("html");
    html.style.fontSize = window.innerHeight / 50 + "px";
});
</script>

<style>
#acc {
    display: flex;
    flex-direction: column;
    position: relative;
    width: 100%;
    height: 100%;
    background: #f7f8fa;
}
#nav {
    flex-shrink: 0;
    width: 100%;
}
#scroll-view {
    width: 100%;
    flex-grow: 1;
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
.router-trans-enter-active， .router-trans-leave-active {
    transition: all 0.5s;
}
.router-trans-enter,
.router-trans-leave-to {
    opacity: 0;
}
.divider {
  height: 0.5rem;
  width: 0.5rem;
}
</style>
