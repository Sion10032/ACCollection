<template>
    <div id="acc" v-if="$auth.ready()">
        <nav-menu></nav-menu>
        <GeminiScrollbar class="my-scroll-bar">
            <main>
                <transition name="router-trans">
                    <router-view name="wrapper">
                    </router-view>
                </transition>
            </main>
        </GeminiScrollbar>
    </div>
</template>

<script>
import NavMenu from './components/NavMenu.vue'

export default {
    components: {
        NavMenu
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const html = document.querySelector('html')
    html.style.fontSize = window.innerHeight / 40 + 'px'
})
</script>

<style scoped>

#acc {
    width: 100%;
    height: 100%;
    background-image: url(/image/background-yuki.jpg);
    background-repeat: repeat;
}

main {
    width: 100%;
    height: 100%;
    padding: 1rem;
    box-sizing: border-box;
}

.my-scroll-bar {
    border: 0rem;
    height: 90%;
}

.router-trans-enter-active，
.router-trans-leave-active {
    transition: all 0.5s;
}

.router-trans-enter,
.router-trans-leave-to {
    /* transform: scaleY(0); */
    opacity: 0;
}

</style>
