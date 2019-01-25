<template>
    <div v-on:click="navItemOnClick">
        <img 
            class="nav-item-icon" 
            v-bind:src="this.icon"
        />
        <a 
            class="nav-item-text" 
            v-show="isNavItemTextShow"
            v-text="this.text"
        />
    </div>
</template>

<script>
export default {
    props: {
        icon: String,
        text: String,
        isNavItemTextShow: Boolean
    },
    methods: {
        navItemOnClick: function() {
           console.log(this.text, 'is clicked.')
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
