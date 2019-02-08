<template>
    <div class="settings-wrapper" v-on:click.self="applySettings(false)">
        <div class="settings-form">
            <div class="settings-item">
                <p class="text">向左开页</p>
                <input 
                    type="checkbox" 
                    class="switch switch-anim"
                    v-model="isReverse"
                />
            </div>
            <div class="settings-item">
                <p class="text">跳转确认</p>
                <input 
                    type="checkbox" 
                    class="switch switch-anim"
                    v-model="isCheck"
                />
            </div>
            <div class="settings-item">
                <p class="text">是否预载</p>
                <input 
                    type="checkbox" 
                    class="switch switch-anim"
                    v-model="isPreLoad"
                />
            </div>
            <div class="apply-button" v-on:click="applySettings(true)">
                <p class="text">Apply</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            isReverse: false,
            isCheck: true,
            isPreLoad: true
        }
    },
    created: function() {
        this.getLocalSettings()
        this.$emit('updateSettings', this.isReverse, this.isCheck, this.isPreLoad)
    },
    methods: {
        applySettings: function(isSave) {
            if (isSave) {
                this.$localStorage.set('isReverse', this.isReverse)
                this.$localStorage.set('isCheck', this.isCheck)
                this.$localStorage.set('isPreLoad', this.isPreLoad)
            }
            else
                this.getLocalSettings()
            this.$emit('updateSettings', this.isReverse, this.isCheck, this.isPreLoad)
            this.$emit('showSettings')
        },
        getLocalSettings: function() {
            this.isReverse = this.$localStorage.get('isReverse', false) == 'true'
            this.isCheck = this.$localStorage.get('isCheck', true) == 'true'
            this.isPreLoad = this.$localStorage.get('isPreLoad', true) == 'true'
        }
    }
}
</script>

<style scoped>

.settings-wrapper {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
    width: 100%;
    height: 100%;
    padding: 1rem;
    box-sizing: border-box;
}

.settings-form {
    width: 100%;
    max-width: 20rem;
    padding-top: 0.5rem;
    box-sizing: border-box;
    background-color: #808080;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.25);
}

.settings-item {
    width: 100%;
    height: 2.5rem;
    padding: 0 1rem 0 1rem;
    box-sizing: border-box;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

select {
    outline: none;
    padding-right: 1rem;
    border-style: none;
    border-radius: 0.5rem;
    background: #808080;
    color: white;
}

.switch {
    position: relative;
    height: 1.2rem;
    width: 2.4rem;
    border-radius: 1.2rem;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    box-sizing: border-box;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.4);
}

.switch:before {
    position: absolute;
    content: '';
    width: 1.2rem;
    height: 1.2rem;
    left: 0;
    border-radius: 1rem;
    background-color: white;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.4);
}

.switch:checked:before {
    left: 1.2rem;
}

.switch.switch-anim {
    transition: background-color 0.5s linear;
    background-color: white;
}

.switch.switch-anim:checked {
    transition: background-color 0.5s linear;
    background-color: #12a4c9;
}

.text {
    font-size: 1rem;
    color: #FFFFFF;
}

.apply-button {
    cursor: pointer;
    width: 100%;
    height: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 -0.5px 0 rgba(0, 0, 0, 0.25);
    margin-top: 0.5rem;
}

.apply-button:hover {
    background-color: #666666;
}

</style>
