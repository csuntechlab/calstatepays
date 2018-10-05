import Industries from "../../../api/industries";
import _industries from "../../mutation-types/industries"
export default {
	fetchIndustries({ commit, dispatch }, payload) {
		Industries.fetchIndustriesAPI(
			payload,
			success => {
				commit(_industries.FETCH_INDUSTRIES, success);
			},
			error => console.log(error)
		);
	},
	fetchIndustryMajorsByField({commit, dispatch}, payload) {
		Industries.fetchIndustryMajorsByFieldAPI(
			payload, 
			(success) => {
				commit(_industries.FETCH_INDUSTRY_MAJORS_BY_FIELD, success);
			},
			(error) => console.log(error)
		)
	}
};
