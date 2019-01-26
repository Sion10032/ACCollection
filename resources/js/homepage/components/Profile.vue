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
            this.goAuthPage()
    },
    methods: {
        goAuthPage: function() {
            this.$router.push({name: 'auth'})
        }
    }
}
</script>

<style scoped>

</style>
