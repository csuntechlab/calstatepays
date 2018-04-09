import Vue from 'vue';
import Vuex from 'vuex';

//MODULES
import Majors from './modules/majors';
import Industries from './modules/industries'

// INIT VUEX
Vue.use(Vuex);

//MODULE MAP
export default new Vuex.Store({
	strict: process.env.NODE_ENV !== 'production',
	modules: {
		Majors,
		Industries,
	}
});