<template>
  <van-tabs color="#1989fa" v-model="selectGroup" sticky>
    <van-tab 
      v-for="(bookInfo, index) in bookGroups"
      :key="index"
      :title="bookInfo.title">
      <book-group
        v-if="bookInfo.data != null"
        :bookGroup="bookInfo.data"
        :name="bookInfo.name">
      </book-group>
    </van-tab>
  </van-tabs>
</template>

<script>
import BookGroup from './BookGroup.vue'

export default {
  components: {
    BookGroup
  },
  data: function () {
    return {
      selectGroup: 'hots',
      bookGroups: [
        {
          name: 'hots',
          title: '热门',
          url: '/SMH/hots',
          data: {
            groupName: '',
            books: []
          }
        },
        {
          name: 'latest',
          title: '最新',
          url: '/SMH/latest',
          data: null
        }
      ]
    }
  },
  mounted: function () {
    for (let bookInfo of this.bookGroups) {
      this.getBookGroup(bookInfo.name)
    }
  },
  methods: {
    getBookGroup: function (name) {
      let bookInfo = this.bookGroups[this.getGroupIndex(name)]
      let _this = this
      this.$axios.get(bookInfo.url).then(function (result) {
        bookInfo.data = {
          groupName: bookInfo.name,
          books: result.data
        }
      })
    },
    getGroupIndex: function (name) {
      for (let i in this.bookGroups) {
        if (this.bookGroups[i].name === name)
          return i
      }
      return -1
    }
  }
}
</script>

<style scoped>
</style>
