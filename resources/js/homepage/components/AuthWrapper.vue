<template>
    <div class="auth-wrapper">
        <div class="auth-form-wrapper">
            <div class="auth-switch">
                <div
                    class="login-wrapper"
                    :class="{ active: pageName == 'login'}"
                    @click="goPage('login')"
                >
                    <p class="text">Login</p>
                </div>
                <div
                    class="register-wrapper"
                    :class="{ active: pageName == 'register'}"
                    @click="goPage('register')"
                >
                    <p class="text">Register</p>
                </div>
            </div>
            <div class="auth-form">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        pageName: String
    },
    methods: {
        goPage: function (name) {
            if (this.pageName == name) console.log('Already in', name, 'page.')
            else this.$router.push({ name: name })
        }
    }
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
}

.text {
    font-size: 1rem;
    color: rgba(0, 0, 0, 0.8);
}

.auth-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-form-wrapper {
    width: 100%;
    max-width: 20rem;
    display: flex;
    flex-direction: column;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 0.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
}

.auth-switch {
    width: 100%;
    height: 2rem;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 0.5rem 0.5rem 0 0;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
}

.active {
    background-color: rgba(216, 216, 216, 0.6);
}

.login-wrapper,
.register-wrapper {
    cursor: pointer;
    width: 50%;
    height: 100%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
}

.login-wrapper:hover,
.register-wrapper:hover {
    background-color: rgba(236, 236, 236, 0.6);
}

.login-wrapper {
    border-radius: 0.5rem 0 0 0;
}

.register-wrapper {
    border-radius: 0 0.5rem 0 0;
}

.auth-form {
    width: 100%;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
    border-radius: 0 0 0.5rem 0.5rem;
}
</style>
