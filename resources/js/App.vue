<template>
    <div>
        <nav-menu></nav-menu>
        <main>
            <router-view></router-view>
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

</style>
