<template>
    <div class="wrapper">
        <reader
            v-bind:chapterData="chapterData"
            v-on:goPrevChapter="goPrevChapter"
            v-on:goNextChapter="goNextChapter"
        >
        </reader>
    </div>
</template>

<script>
import Reader from './components/Reader.vue'

export default {
    components: {
        Reader
    },
    data: function () {
        return {
            chapterData: {},
            token: '',
            curUid: 0,
            curFid: 0,
            curBid: 0
        }
    },
    created: function () {
        this.getChapterData()
    },
    methods: {
        getChapterData: function () {
            var url = window.location.pathname
            var _this = this
            this.$axios.get(url).then(function (result) {
                var tmp = {}
                tmp['bid'] = result.data['bid']
                tmp['cid'] = result.data['cid']
                tmp['prevCid'] = result.data['prevCid']
                tmp['nextCid'] = result.data['nextCid']
                tmp['title'] = result.data['title']
                tmp['chapter'] = result.data['chapter']
                tmp['files'] = new Array(result.data['files'].length)
                for (let i = 0; i < result.data['files'].length; ++i)
                    tmp['files'][i] = 
                        '/SMH/pic?path=' + result.data['path'] + result.data['files'][i]
                        + result.data['param'].replace('?', '&')
                _this.chapterData = tmp
            })
            _this.updateFavorite()
        },
        updateFavorite: function () {
            this.getLocalCurInfo()
            let bid = window.location.pathname.split('/')[3]
            let cid = window.location.pathname.split('/')[5]

            if (this.token && this.curUid && this.curFid && this.curBid) {
                if (bid == this.curBid) {
                    let url = '/users/' + this.curUid + '/favorites/' + this.curFid
                    this.$axios({
                        method: "PUT",
                        url: url,
                        headers: {
                            'Authorization': 'bearer ' + this.token
                        },
                        data: {
                            lastChapter: cid
                        }
                    }).then(function (res) {
                        console.log('update success.', res.data)
                    }).catch(function () {
                        console.log('update fail.')
                    })
                }
                else {
                    console.log('bid not match.')
                }
            }
        },
        getLocalCurInfo: function () {
            this.token = this.$localStorage.get('default_auth_token')
            this.curUid = this.$localStorage.get('cur_uid')
            this.curFid = this.$localStorage.get('cur_fid')
            this.curBid = this.$localStorage.get('cur_bid')
        },
        goPrevChapter: function () {
            console.log('goPrevChapter')
            if (this.chapterData.prevCid == 0)
                alert('已经是第一章')
            else
                window.location.href =
                    '/SMH/books/' + this.chapterData.bid +
                    '/chapters/' + this.chapterData.prevCid
        },
        goNextChapter: function () {
            console.log('goNextChapter')
            if (this.chapterData.nextCid == 0)
                alert('已经是最后一章')
            else
                window.location.href =
                    '/SMH/books/' + this.chapterData.bid +
                    '/chapters/' + this.chapterData.nextCid
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
