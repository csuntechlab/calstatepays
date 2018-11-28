/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
var SocialSharing = require("vue-social-sharing");
// import '../../../node_modules/font-awesome/css/font-awesome.min.css';
import Vue from 'vue';
import axios from 'axios';
import router from './router';
import store from './store';
import Vuetify from 'vuetify';
import vSelect from 'vue-select';
import VueYoutube from 'vue-youtube'


Vue.use(Vuetify, {
    iconfont: 'fa4'
});
Vue.use(SocialSharing);
Vue.use(VueYoutube);

import App from './App.vue';
import { mapGetters } from 'vuex';
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
    mounted(){
        this.$store.dispatch('fetchMajors', this.selectedUniversity);
        this.$store.dispatch('fetchFieldOfStudies',this.selectedUniversity);
        this.$store.dispatch('fetchUniversities');
    },

    computed: {
        ...mapGetters([
            'selectedUniversity'
        ])
    }
});

export default vm;


