<template>
  <div class="home-wrapper">
    <book-group
      v-for="(bookGroup, index) in bookGroups"
      :key="index"
      :bookGroup="bookGroup">
    </book-group>
  </div>
</template>

<script>
import BookGroup from './BookGroup.vue'

export default {
  components: {
    BookGroup
  },
  data: function () {
    return {
      bookGroups: []
    }
  },
  mounted: function () {
    this.getHotsBooks()
    this.getLatestBooks()
  },
  methods: {
    getHotsBooks: function () {
      var _this = this
      this.$axios.get('/SMH/hots').then(function (result) {
        _this.bookGroups.unshift({
          groupName: 'Hots', books: result.data
        })
      })
    },
    getLatestBooks: function () {
      var _this = this
        this.$axios.get('/SMH/latest').then(function (result) {
          _this.bookGroups.push({
            groupName: 'Latest', books: result.data
        })
      })
    }
  }
}
</script>

<style scoped>
.home-wrapper {
  padding: 0;
  box-sizing: border-box;
}
</style>
