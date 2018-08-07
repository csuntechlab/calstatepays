import Vue from 'vue';
import Vuex from 'vuex';

//MODULES
import Majors from './modules/majors';
import Pfre from './modules/pfre';
import Global from './modules/global-form';
import Industries from './modules/industries';

// INIT VUEX
Vue.use(Vuex);

//MODULE MAP
export default new Vuex.Store({
	strict: process.env.NODE_ENV !== 'production',
	modules: {
		Majors,
		Pfre,
		Global,
		Industries
	}
});