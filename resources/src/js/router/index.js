import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';


//PAGES
import home from './views/home/index.vue';
// INIT VUE-ROUTER
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{ path: '/', component: home },
	]
});

export default router;