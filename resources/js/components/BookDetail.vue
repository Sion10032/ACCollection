<template>
    <h1> {{ bookDetial }} </h1>
</template>

<script>
export default {
    props: {
        bid: String
    },
    data: function() {
        return {
            bookDetial: {}
        }
    },
    mounted: function() {
        this.getBookDetail();
    },
    methods: {
        getBookDetail: function() {
            var url = '/api/SMH/books/' + this.bid
            var _this = this
            this.$axios.get(url).then(function(result) {
                _this.bookDetial = result.data
            })
        }
    }
}
</script>

<style scoped>

</style>
