/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Vue from 'vue';
import axios from 'axios';
import router from './router';
import store from './store';
import Vuetify from 'vuetify';

Vue.use(Vuetify)

import App from './App.vue';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const vm = new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App),
    created(){
        this.$store.dispatch('fetchMajors');
        /*this.$store.dispatch('fetchIndustryImages');*/
    }
});


export default vm;


