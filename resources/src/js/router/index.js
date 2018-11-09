import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate'
import store from '../store';

//PAGES
import home from './views/home/index.vue';
import pfre from './views/pfre/index.vue';
import majors from './views/majors/index.vue';
import industries from './views/industries/index.vue';
import faq from './views/faq/index.vue';
import research from './views/research/index.vue';
import researchcsun from './views/researchcsun/index.vue';
import researchall from './views/researchall/index.vue';

import about from './views/about/index.vue';
import splashPage from './views/splashPage/index.vue';

// INIT VUE-ROUTER
Vue.use(VueRouter);
Vue.use(Vuelidate);
const router = new VueRouter({
	routes: [
		{ path: '/', component: home },
		{path: '/data/pfre',component: splashPage},
		//{ path: '/data/pfre', component: pfre },
		{ path: '/data/industries', component: industries},
		{ path: '/data/majors', component: majors },
		{ path: '/faq', component: faq},
		{ path: '/research', component: research},
		{ path: '/researchcsun', component: researchcsun},
		{ path: '/tableauHolder', name:'all',component: researchall , props:true}
	]
});

router.beforeEach(function (to, from, next) {
	setTimeout(() => {
		window.scrollTo(0,0);
	}, 100);
	next();
})

export default router;