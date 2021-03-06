
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

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);
/*
import CompaniesIndex from './components/companies/CompaniesIndex.vue';
import CompaniesCreate from './components/companies/CompaniesCreate.vue';
import CompaniesEdit from './components/companies/CompaniesEdit.vue';
*/
import zonesEdit from './components/zonesEdit.vue';
import zonesIndex from './components/zonesIndex.vue';
import zonesCreate from './components/zonesCreate.vue';


const routes = [
    {
        path: '/',
        components: {
            zonesIndex: zonesIndex
        }
    },
    {path: '/admin/companies/create', component: zonesCreate, name: 'createZone'},
    {path: '/admin/companies/edit/:Number', component: zonesEdit, name: 'editZone'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
