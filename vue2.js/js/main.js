
var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!',
        styleCSS: ''
    },
    methods: {
        changeText(){
            this.message="FUCK"
        }
    }
})
