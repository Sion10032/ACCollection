<template>
    <auth-wrapper :pageName="'register'">
        <form>
            <p class="text">Name:</p>
            <radius-input v-model="name" />
            <p class="text">E-Mail:</p>
            <radius-input v-model="email" />
            <p class="text">Password:</p>
            <radius-input
                type="password"
                v-model="pwd"
            />
            <p class="text">Confirm Password:</p>
            <radius-input
                type="password"
                v-model="confirmPwd"
            />
        </form>
        <div class="option-wrapper"></div>
        <div class="button-wrapper">
            <radius-button
                :text="'Register'"
                @click.native="registerClick"
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
            name: '',
            email: '',
            pwd: '',
            confirmPwd: ''
        }
    },
    beforeCreate: function () {
        if (this.$auth.check()) this.$router.push({ name: 'home' })
    },
    methods: {
        registerClick: function () {
            if (this.pwd != this.confirmPwd) {
                console.log('Pwd not equal.')
                return
            }
            this.$auth.register({
                data: {
                    name: this.name,
                    email: this.email,
                    password: this.pwd
                },
                success: function () {
                    console.log('Register success.')
                },
                error: function () {
                    console.log('Register fail.')
                },
                redirect: { name: 'login' }
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
