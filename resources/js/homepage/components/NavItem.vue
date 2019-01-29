<template>
    <div v-on:click="navItemOnClick">
        <img 
            class="nav-item-icon" 
            v-bind:src="this.infos.icon"
        />
        <p
            class="nav-item-text" 
            v-show="isNavItemTextShow"
            v-text="this.infos.name"
        />
    </div>
</template>

<script>
export default {
    props: {
        infos: {
            icon: String,
            name: String,
            router: String,
            params: Object
        },
        isNavItemTextShow: Boolean
    },
    methods: {
        navItemOnClick: function() {
            console.log(this.infos.name, 'is clicked.')
            if (this.infos.router != '')
                this.$router.push({name: this.infos.router, params: this.infos.params})
        }
    }
}
</script>

<style scoped>

div {
    height: 100%;
    display: flex;
    align-items: center;
    justify-items: center;
}

.nav-item-icon {
    height: 60%;
    margin: 0.25rem;
    object-fit: scale-down
}

.nav-item-text {
    font-size: 0.8rem;
    color: white;
}

</style>
