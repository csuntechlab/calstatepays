import Industries from "../../../api/industries";
import _industries from "../../mutation-types/industries"

export default {
	fetchIndustries({ commit, dispatch }, payload) {
		Industries.fetchIndustriesAPI(
			payload,
			success => {
				commit(_industries.FETCH_INDUSTRIES, success);
			},
			error => commit(_global.ERROR_ALERT,error)
		);
	}
};
