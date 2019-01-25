<template>
    <div 
        class="nav-item" 
        v-bind:class="{ 'nav-item-selected' : this.name == this.selectedItem}"
        v-on:click="this.navItemOnClick"
    >
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
        name: String,
        selectedItem: String,
        icon: String,
        text: String,
        isNavItemTextShow: Boolean
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
    display: flex;
    align-items: center;
    justify-items: center;
    height: 100%;
    padding: 0 0.5rem 0 0.5rem;
}

.nav-item:hover {
    background-color: rgba(72, 72, 72, 0.6);
}

.nav-item-selected {
    background-color: rgba(64, 64, 64, 0.8);
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
