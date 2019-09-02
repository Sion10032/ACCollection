<template>
    <auth-wrapper :pageName="'login'">
        <form>
            <p class="text">E-Mail:</p>
            <radius-input v-model="email" />
            <p class="text">Password:</p>
            <radius-input
                type="password"
                v-model="pwd"
            />
        </form>
        <div class="option-wrapper">
            <input
                type="checkbox"
                class="rem-checkbox"
                v-model="remb"
            >
            <p class="ptext">Remember Me</p>
        </div>
        <div class="button-wrapper">
            <radius-button
                :text="'Login'"
                @click.native="loginClick"
            />
        </div>
    </auth-wrapper>
</template>

<script>
import AuthWrapper from './AuthWrapper.vue'
import RadiusButton from './RadiusButton.vue'
import RadiusInput from './RadiusInput.vue'

export default {
    components: {
        AuthWrapper,
        RadiusButton,
        RadiusInput
    },
    data: function () {
        return {
            email: '',
            pwd: '',
            remb: true
        }
    },
    beforeCreate: function () {
        if (this.$auth.check()) this.$router.push({ name: 'home' })
    },
    methods: {
        loginClick: function () {
            console.log('login clicked.')
            this.$auth.login({
                data: {
                    email: this.email,
                    password: this.pwd
                },
                rememberMe: this.remb,
                fetchUser: true,
                redirect: { name: 'home' },
                success: function () {
                    console.log('login success.')
                },
                error: function () {
                    console.log('login fail.')
                }
            })
        }
    }
}
</script>

<style scoped>
.text {
    color: rgba(0, 0, 0, 0.75);
    font-size: 0.8rem;
}

.option-wrapper {
    height: 1rem;
    width: 100%;
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
}

.rem-checkbox {
    height: 0.8rem;
    width: 0.8rem;
}

.ptext {
    font-size: 0.75rem;
}

.button-wrapper {
    display: flex;
    justify-content: flex-end;
}
</style>
