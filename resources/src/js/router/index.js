import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';


//PAGES
import home from './views/home/index.vue';
import pfre from './views/pfre/index.vue';
import majors from './views/majors/index.vue';
import industries from './views/industries/index.vue';

// INIT VUE-ROUTER
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{ path: '/', component: home },
		{ path: '/pfre', component: pfre },
		{ path: '/majors', component: majors },
		{ path: '/industries', component: industries }
	]
});

export default router;