<template>
    <input
        class="input-el"
        :value="value"
        @input="$emit('input', $event.target.value)"
    />
</template>

<script>
export default {
    props: {
        value: String
    }
}
</script>

<style scoped>
.input-el {
    color: rgba(0, 0, 0, 0.75);
    background-color: rgba(235, 235, 235, 0.6);
    width: 100%;
    height: 1.5rem;
    padding: 0 0.75rem 0 0.75rem;
    margin: 0.5rem 0 1.5rem 0;
    border: 0rem;
    outline: none;
    border-radius: 0.75rem;
    box-sizing: border-box;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
}
</style>
