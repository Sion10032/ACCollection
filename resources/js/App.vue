<template>
    <div id="acc">
        <nav-menu></nav-menu>
        <GeminiScrollbar class="my-scroll-bar">
            <main>
                <router-view name="wrapper"></router-view>
            </main>
        </GeminiScrollbar>
    </div>
</template>

<script>
import NavMenu from './components/Navmenu.vue'

export default {
    components: {
        NavMenu
    }
}
</script>

<style scoped>

#acc {
    width: 100%;
    height: 100%;
    /* background-image: url(/image/background-shinku-00.jpg);
    background-size: cover; */
}

main {
    width: 100%;
    height: 100%;
    padding: 1rem;
    box-sizing: border-box;
}

.my-scroll-bar {
    height: 90%;
}

</style>
