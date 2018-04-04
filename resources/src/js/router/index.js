import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';

//PAGES
import home from './views/home/index.vue';
import pfre from './views/pfre/index.vue';
import majors from './views/majors/index.vue';
import industries from './views/industries/index.vue';
import faq from './views/faq/index.vue';

// INIT VUE-ROUTER
Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{ path: '/', component: home },
		{ path: '/majors', component: majors },
		{ path: '/pfre', component: pfre },
		{ path: '/industries', component: industries},
		{ path: '/faq', component: faq}
	]
});

export default router;