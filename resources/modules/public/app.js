require('./bootstrap');
//imports
import Vue from 'vue';
import routes from '../public/router'
import App from './App.vue';

window.Vue = require('vue');


const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router: routes,
});