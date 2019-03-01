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
import tableauHolder from './views/tableauHolder/index.vue';
import feedback from './views/feedback/index.vue'

import about from './views/about/index.vue';
import splashPage from './views/splashPage/index.vue';

// INIT VUE-ROUTER
Vue.use(VueRouter);
Vue.use(Vuelidate);
const router = new VueRouter({
	routes: [
		{ 
			path: '/', 
			component: home,
			meta: {
				title: 'Home | CalStatePays'
			}
		},
		{ 
			path: '/data/pfre',
			component: splashPage,
			name: 'pfre',
			meta: {
				title: 'FRE | CalStatePays'
			}
		},
		// { 
		// 	path: '/data/pfre',
		// 	component: pfre,
		// 	name: 'pfre',
		// 	meta: {
		// 		title: 'Data - FRE | CalStatePays'
		// 	}
		// },
		{ 
			path: '/data/industries', 
			component: industries, 
			name: 'industries',
			meta: {
				title: 'Data - Industries | CalStatePays'
			}
		},
		{ 
			path: '/data/majors', 
			component: majors, 
			name: 'majors',
			meta: {
				title: 'Data - Majors | CalStatePays'
			} 
		},
		{ 
			path: '/faq', 
			component: faq,
			name: 'FAQ',
			meta: {
				title: 'FAQ | CalStatePays'
			}
		},
		{ 
			path: '/research', 
			component: research,
			meta: {
				title: 'Research | CalStatePays'
			} 
		},
		{ 
			path: '/tableau', 
			name: 'tableau', 
			component: tableauHolder, 
			props: true,
			meta: {
				title: 'Tableau Info | CalStatePays'
			}
		},
		{
			path: '/feedback',
			component: feedback,
			name: 'feedback',
			meta: {
				title: 'Feedback | CalStatePays'
			}
		}
	]
});

router.beforeEach(function (to, from, next) {
	setTimeout(() => {
		window.scrollTo(0, 0);
	}, 100);
	document.title = to.meta.title

	next();
})

export default router;