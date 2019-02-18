<template>
    <div
        class="nav-item"
        v-bind:class="{ 'nav-item-selected' : name == selectedItem}"
        v-on:click="navItemOnClick"
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
        navItemOnClick: function () {
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
    background-color: rgba(0, 0, 0, 0.4);
}

.nav-item-selected {
    background-color: rgba(0, 0, 0, 0.25);
}
</style>
