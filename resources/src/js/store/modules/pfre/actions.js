// PFRE ACTIONS
import Pfre from "../../../api/pfre";
import _pfre from "../../mutation-types/pfre";
import _global from "../../mutation-types/global-form"

export default {
	fetchMockData({ commit, dispatch }) {
		commit(_pfre.FETCH_MOCK_DATA);
	},

	fetchFreData({ commit, dispatch }, payload) {
		commit(_pfre.TRIGGER_IS_LOADING);
		Pfre.fetchFreDataAPI(
			payload,
			success => {
				commit(_pfre.FETCH_FRE_DATA, success);
				commit(_pfre.TRIGGER_IS_LOADING);
			},
			error => {
				commit(_global.ERROR_ALERT, {message: 'Oops! Major data unavailable'});
				commit(_pfre.TRIGGER_IS_LOADING);
			}
		);
	},

	toggleInfo({ commit }, payload) {
		commit(_pfre.TOGGLE_INFO, payload);
	},

	submitPfreForm({ commit }) {
		commit(_pfre.SUBMIT_PFRE);
	},

	resetFreState({ commit }) {
		commit(_pfre.RESET_FRE_STATE);
	},

	setPfreSelections({ commit }, payload) {
		commit(_pfre.SET_PFRE, payload);
	}
};
