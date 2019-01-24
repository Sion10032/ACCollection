<template>
    <div class="wrapper">
        <reader v-bind:chapterData="this.chapterData"></reader>
    </div>
</template>

<script>
import Reader from './components/Reader.vue'

export default {
    components: {
        Reader
    },
    data: function() {
        return {
            chapterData: {}
        }
    },
    created: function() {
        this.getChapterData()
    },
    methods:{
        getChapterData: function() {
            var url = '/api' + window.location.pathname
            var _this = this
            this.$axios.get(url).then(function(result) {
                _this.chapterData = result.data
            })
        }
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const html = document.querySelector('html')
    html.style.fontSize = window.innerHeight / 50 + 'px'
})
</script>

<style scoped>

.wrapper {
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
}

</style>
