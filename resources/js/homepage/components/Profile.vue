<template>
    <div class="page-wrapper">
        <div
            class="profile-wrapper"
            v-if="userId != 0"
        >
            <img
                class="avatar"
                :src="
                    '/image/ui/avatar-' + 
                    (this.$auth.user().id == userId ? 'karen.png' : 'saki.png')
                "
            />
            <p class="text tag"> User Name: </p>
            <p class="text"> {{ userData.name }} </p>
            <p class="text tag"> User ID: </p>
            <p class="text"> {{ userData.id }} </p>
            <p class="text tag"> Join Date: </p>
            <p class="text"> {{ userData.created_at }} </p>
            <radius-button
                class="logout-button"
                v-if="this.$auth.user().id == userId"
                :text="'Logout'"
                @click.native="logoutClick"
            />
        </div>
    </div>
</template>

<script>
import RadiusButton from './RadiusButton.vue'

export default {
    components: {
        RadiusButton
    },
    props: {
        userId: String
    },
    data: function () {
        return {
            userData: Object
        }
    },
    watch: {
        userId: function () {
            if (this.userId == '0')
                this.redircet()
            else
                this.getUserInfo()
        }
    },
    created: function () {
        if (this.userId == '0')
            this.redircet()
        else
            this.getUserInfo()
    },
    methods: {
        redircet: function () {
            if (!this.$auth.check())
                this.$router.push({ name: 'login' })
            else
                this.$router.push({ name: 'user', params: { userId: this.$auth.user().id.toString() } })
        },
        getUserInfo: function () {
            console.log('getUserInfo')
            this.$axios({
                methods: 'GET',
                url: '/users/' + this.userId
            }).then(res => {
                this.userData = res.data.data
            }).catch(() => { })
        },
        logoutClick: function () {
            this.$auth.logout({
                method: 'GET',
                makeRequest: true
            })
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
    font-size: 0.8rem;
    margin-bottom: 0.3rem;
    color: rgba(0, 0, 0, 0.8);
}

.tag {
    margin-top: 0.7rem;
}

.page-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-wrapper {
    width: 100%;
    max-width: 20rem;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 0.5rem;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
}

.avatar {
    width: 6rem;
    height: 6rem;
    margin-bottom: 0.7rem;
    border-radius: 50%;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.25);
}

.logout-button {
    margin-top: 1rem;
}
</style>
