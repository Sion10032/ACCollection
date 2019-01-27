<template>
    <div class="auth-form-wrapper">
        <div class="auth-form">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>

* {
    margin: 0;
    padding: 0;
}

.auth-form-wrapper {
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-form {
    display: flex;
    flex-direction: column;
    background-color: rgba(255, 255, 255, 0.6);
    width: 100%;
    max-width: 20rem;
    padding: 1.5rem;
    box-sizing: border-box;
    border-radius: 0.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
}

</style>
