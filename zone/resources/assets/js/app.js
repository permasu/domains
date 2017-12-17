
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('phone', require('./components/phone2.vue'));
/////////////////////////////////
/*
var Vue = require('vue');

var VueRouter = require('vue-router');

Vue.use(VueRouter);

var App = Vue.extend({});



var Home = Vue.extend({
    template: 'Добро пожаловать на <b>главную страницу</b>!'
});

var People = Vue.extend({
    template: 'Посмотрите на всех, кто тут работает!'
});

router.map({
    '/': {
        component: Home
    },
    '/people': {
        component: People
    }
});



var router = new VueRouter({
    routes: [
        { path: '/', component: Home },
        { path: '/people', component: People }
    ]
})
*/
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const Foo       = { template: '<div>foo</div>' }
const Bar       = { template: '<div>bar</div>' }
const people    = { template: '<div>People</div>' }

const routes = [
    { path: '/foo', component: Foo },
    { path: '/bar', component: Bar },
    { path: '/people', component: people }
]

const router = new VueRouter({routes // сокращение от `routes: routes`
})

/////////////////////////////////

const app = new Vue({
    el: '#app',
    router

}).$mount('#app');
