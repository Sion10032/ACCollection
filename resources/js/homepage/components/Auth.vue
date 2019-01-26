<template>
    <div class="auth-form-wrapper">
        <div class="auth-form">
            <form>
                <p class="text">E-Mail:</p>
                <input class="input-el"/>
                <p class="text">Password:</p>
                <input class="input-el" type="password"/>
            </form>
            <div class="option-wrapper">
            </div>
            <div class="button-wrapper">
                <button style="display: none">Register</button>
                <button>Login</button>
            </div>
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
    border-radius: 0.2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
}

.text {
    color: rgba(0, 0, 0, 0.75);
    font-size: 0.8rem;
}

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

.button-wrapper {
    display: flex;
    justify-content: flex-end;
}

button {
    cursor: pointer;
    color: rgba(88, 178, 220, 0.8);
    background-color: rgba(255, 255, 255, 0.6);
    font-size: 0.8rem;
    height: 2rem;
    width: 6rem;
    outline: none;
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
}

button:hover {
    background-color: rgba(192, 192, 192, 0.25);
}

</style>
