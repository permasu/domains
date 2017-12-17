
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

window.Vue.use(VueRouter);
/*
import CompaniesIndex from './components/companies/CompaniesIndex.vue';
import CompaniesCreate from './components/companies/CompaniesCreate.vue';
import CompaniesEdit from './components/companies/CompaniesEdit.vue';
*/
import zonesIndex from './components/zonesIndex.vue';

const routes = [
    {
        path: '/',
        components: {
            zonesIndex: zonesIndex
        }
    },
  //  {path: '/admin/companies/create', component: CompaniesCreate, name: 'createCompany'},
   // {path: '/admin/companies/edit/:id', component: CompaniesEdit, name: 'editCompany'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
