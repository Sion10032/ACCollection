<template>
    <div id="app">
        <nav-menu></nav-menu>
        <main>
            <router-view name="wrapper"></router-view>
        </main>
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

#app{
    width: 100%;
    height: 100%;
}

main {
    width: 100%;
    height: 100%;
}

</style>
