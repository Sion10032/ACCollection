<template>
    <div
        class="avatar-wrapper"
        v-on:click="avatarClick"
    >
        <img
            class="avatar"
            v-bind:src="this.$auth.check() ? '/image/ui/avatar-karen.png' : '/image/ui/avatar-saki.png'"
        >
    </div>
</template>

<script>
export default {
    methods: {
        avatarClick: function () {
            this.$router.push({ name: 'user', params: { userId: '0' } })
        }
    }
}
</script>

<style scoped>
.avatar-wrapper {
    display: contents;
}

.avatar {
    width: 2rem;
    height: 2rem;
    background-color: white;
    border-radius: 100%;
    /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25); */
}
</style>
