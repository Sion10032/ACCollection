<template>
    <div class="profile-wrapper" v-if="this.userId != 0">
        <p>UserProfile: {{ this.userId }}</p>
    </div>
</template>

<script>
export default {
    props: {
        userId: String
    },
    created: function() {
        if (this.userId == '0')
            this.redircet()
    },
    methods: {
        redircet: function() {
            if (!this.$auth.check())
                this.$router.push({name: 'login'})
            else
                this.$router.push({name: 'user', params: { userId: this.$auth.user().id.toString() }})
        }
    }
}
</script>

<style scoped>

</style>
