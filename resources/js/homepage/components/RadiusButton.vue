<template>
    <button> {{ this.text }} </button>
</template>

<script>
export default {
    props: {
        text: String
    }
}
</script>

<style scoped>

button {
    cursor: pointer;
    color: rgba(88, 178, 220, 0.8);
    background-color: rgba(255, 255, 255, 0.6);
    font-size: 0.75rem;
    height: 1.5rem;
    padding: 0 1rem 0 1rem;
    outline: none;
    border: 0;
    border-radius: 0.75rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
}

button:hover {
    background-color: rgba(192, 192, 192, 0.25);
}

</style>
