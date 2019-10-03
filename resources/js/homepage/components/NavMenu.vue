<template>
  <van-tabbar route v-model="selected" :fixed="false">
    <van-tabbar-item 
      name="home"
      replace
      :to="{name: 'home'}"
      icon="home-o"
    >
      主页
    </van-tabbar-item>
    <van-tabbar-item
      name="like"
      replace
      :to="{name: 'favorites', params: { userId: '0' }}"
      icon="like-o"
    >
      收藏
    </van-tabbar-item>
    <van-tabbar-item
      name="search"
      replace
      icon="search"
    >
      搜索
    </van-tabbar-item>
    <van-tabbar-item
      name="me"
      replace
      :to="{name: 'user', params: { userId: '0' }}"
      icon="user-o"
    >
      我
    </van-tabbar-item>
  </van-tabbar>
    <!-- <div class="navbar">
        <ul class="nav-menu nav-menu-left">
            <li
                is="nav-item-slot"
                v-for="(navItem, index) in navItems"
                v-bind:key="index"
                v-bind:name="navItem.name"
                v-bind:selectedItem="selectedItem"
                v-on:setSelectedItem="setSelectedItem"
            >
                <nav-item
                    v-bind:infos="navItem"
                    v-bind:isNavItemTextShow="isNavItemTextShow"
                >
                </nav-item>
            </li>
            <li
                class="fresh-button"
                v-on:click="freshClick"
            >
                <img
                    class="fresh-button-icon"
                    src="/image/navbar/fresh.png"
                />
            </li>
        </ul>
        <ul class="nav-menu nav-menu-right">
            <li
                is="nav-item-slot"
                v-bind:name="'SearchBar'"
                v-bind:selectedItem="selectedItem"
                v-on:setSelectedItem="preventSearchBarSelected"
            >
                <search-bar></search-bar>
            </li>
            <li
                is="nav-item-slot"
                v-bind:name="'Avatar'"
                v-bind:selectedItem="selectedItem"
                v-on:setSelectedItem="setSelectedItem"
            >
                <nav-avatar></nav-avatar>
            </li>
        </ul>
    </div> -->
</template>

<script>
export default {
  components: {
  },
  data() {
    return {
      selected: 'home',
    }
  },
  methods: {
  }
};
</script>

<style scoped>
</style>
