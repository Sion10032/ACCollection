<template>
  <div class="profile-wrapper">
    <div class="me-info-wrapper">
      <van-image 
        class="avatar" round
        :src="'/image/ui/avatar-' + (this.$auth.user().id == userId ? 'karen.png' : 'saki.png')"
      />
      <div class="me-info">
        <p class="me-name">{{ userData.name }}</p>
        <div class="divider"/>
        <div class="divider"/>
        <p class="me-profile">{{ userData.id }}</p>
        <div class="divider"/>
        <p class="me-profile">{{ userData.created_at }}</p>
      </div>
    </div>
    <van-cell-group>
        <van-cell title="登录" v-show="!$auth.check()" clickable to="login"/>
        <van-cell title="退出登录" clickable @click="logoutClick"/>
    </van-cell-group>
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
.profile-wrapper {
  width: 100%;
}
.me-info-wrapper {
  padding: 20px 10px;
  display: flex;
  flex-direction: row;
}
.avatar {
  width: 6rem;
  height: 6rem;
  margin-bottom: 0.7rem;
  border-radius: 50%;
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.25);
}
.me-info {
  padding: 0 20px;
}
.me-info p {
  margin: 0;
  padding: 0;
  text-align: left;
}
.me-name {
  font-size: 1.5rem;
  font-weight: 500;
}
.me-profile {
  font-size: 1rem;
  font-weight: 300;
}
</style>
