<template>
    <div 
        class="nav-item" 
        v-bind:class="{ 'nav-item-selected' : this.name == this.selectedItem}"
        v-on:click="this.navItemOnClick"
    >
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        name: String,
        selectedItem: String
    },
    methods: {
        navItemOnClick: function() {
            this.$emit('setSelectedItem', this.name)
        }
    }
}
</script>

<style scoped>

.nav-item {
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
    justify-items: center;
    padding: 0 0.5rem 0 0.5rem;
}

.nav-item:hover {
    background-color: rgba(72, 72, 72, 0.6);
}

.nav-item-selected {
    background-color: rgba(64, 64, 64, 0.8);
}

</style>
