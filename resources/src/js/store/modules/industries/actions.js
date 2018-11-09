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
	},
	fetchIndustryMajorsByField({commit, dispatch}, payload) {
		Industries.fetchIndustryMajorsByFieldAPI(
			payload, 
			(success) => {
				commit(_industries.FETCH_INDUSTRY_MAJORS_BY_FIELD, success);
			},
			(error) => console.log(error)
		);
	},
	resetIndustryCard({commit}){
		commit(_industries.RESET_INDUSTRY_CARD);
	},
	resetIndustryState({commit}){
		commit(_industries.RESET_INDUSTRY_STATE);
	},
	toggleIndustryFormWasSubmitted({commit}){
		commit(_industries.TOGGLE_INDUSTRY_FORM_WAS_SUBMITTED);
	},
	toggleIndustryEducationLevel({commit}, payload){
		commit(_industries.TOGGLE_INDUSTRY_EDUCATION_LEVEL, payload);
	}

};
