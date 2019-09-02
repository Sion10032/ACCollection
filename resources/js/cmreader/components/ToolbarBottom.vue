<template>
    <transition name="slide-up">
        <div
            class="toolbar footer"
            v-show="isToolbarShow"
        >
            <div
                class="item-wrapper progress"
                :class="{ 're-dir' : isReverse }"
            >
                <p class="text"> {{ totalPage }} </p>
                <input
                    id="proline"
                    :class="{ reverse : !isReverse }"
                    type="range"
                    min="1"
                    :max="totalPage"
                    :value="curPage + 1"
                    @input="$emit('changePage', $event.target.value - 1)"
                />
                <p class="text"> {{ curPage + 1 }} </p>
            </div>
            <div
                class="item-wrapper"
                @click="settingsClick"
            >
                <img
                    class="button-img"
                    src="/image/ui/settings.png"
                />
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        isReverse: Boolean,
        isToolbarShow: Boolean,
        totalPage: Number,
        curPage: Number
    },
    watch: {
        curPage: function () {
            let pl = document.getElementById('proline')
            pl.style['background-size'] = this.curPage / (this.totalPage - 1) * 100 + "% 100%"
        }
    },
    methods: {
        settingsClick: function () {
            this.$emit('showSettings')
        }
    }
};
</script>

<style scoped>
* {
    margin: 0;
}

.toolbar {
    position: absolute;
    z-index: 30;
    background-color: #555555;
    width: 100%;
    height: 4rem;
}

.footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    bottom: 0;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.25);
}

.text {
    color: #fff;
    margin: 0 1rem 0 1rem;
    flex-shrink: 0;
}

.slide-up-enter-active,
.slide-up-leave-active {
    transition: all 0.5s;
}

.slide-up-enter,
.slide-up-leave-to {
    transform: translateY(100%);
    opacity: 0;
}

.item-wrapper {
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0;
    box-sizing: border-box;
}

.item-wrapper:hover {
    background-color: rgba(0, 0, 0, 0.25);
}

.re-dir {
    flex-direction: row-reverse;
}

.progress {
    flex-grow: 1;
    justify-content: space-around;
}

#proline {
    flex-grow: 1;
}

.reverse {
    transform: scaleX(-1);
}

input[type="range"] {
    outline: none;
    -webkit-appearance: none;
    background: -webkit-linear-gradient(#12a4c9, #12a4c9) no-repeat, #ddd;
    background-size: 0% 100%;
    height: 0.3rem;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 1.5rem;
    width: 1.5rem;
    background: #fff;
    border-radius: 50%;
    border: solid 1px #ddd;
}

.button-img {
    width: 2rem;
    height: 2rem;
    margin: 1rem;
}
</style>
