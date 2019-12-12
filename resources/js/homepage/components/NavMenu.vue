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
                :key="index"
                :name="navItem.name"
                :selectedItem="selectedItem"
                @setSelectedItem="setSelectedItem"
            >
                <nav-item
                    :infos="navItem"
                    :isNavItemTextShow="isNavItemTextShow"
                >
                </nav-item>
            </li>
            <li
                class="fresh-button"
                @click="freshClick"
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
                :name="'SearchBar'"
                :selectedItem="selectedItem"
                @setSelectedItem="preventSearchBarSelected"
            >
                <search-bar></search-bar>
            </li>
            <li
                is="nav-item-slot"
                :name="'Avatar'"
                :selectedItem="selectedItem"
                @setSelectedItem="setSelectedItem"
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
