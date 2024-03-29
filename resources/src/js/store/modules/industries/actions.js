import Industries from "../../../api/industries";
import _industries from "../../mutation-types/industries"
import _majors from "../../mutation-types/majors"
import _global from '../../mutation-types/global-form';
export default {
	fetchIndustries({ commit, dispatch }, payload) {
		commit(_industries.TRIGGER_IS_LOADING, payload);
		Industries.fetchIndustriesAPI(
			payload,
			success => {
				commit(_industries.FETCH_INDUSTRIES, success);
				commit(_industries.TRIGGER_IS_LOADING, success);
			},
            (error) => {
                commit(_global.ERROR_ALERT, { message: 'Oops! Major data unavailable' })
            }
		);
	},
	fetchIndustryMajorsByField({commit, dispatch}, payload) {
        commit(_industries.SET_DISCIPLINE_LOAD, true);
		Industries.fetchIndustryMajorsByFieldAPI(
			payload, 
			(success) => {
                commit(_industries.FETCH_INDUSTRY_MAJORS_BY_FIELD, success);
                commit(_industries.SET_DISCIPLINE_LOAD, false);
			},
			(error) => commit(_global.ERROR_ALERT,error)
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
		commit(_majors.TOGGLE_FORM_WAS_SUBMITTED);
	},
	toggleIndustryEducationLevel({commit}, payload){
		if(payload == null) payload = "bachelors"
		commit(_industries.TOGGLE_INDUSTRY_EDUCATION_LEVEL, payload);
	},
	setIndustryMajor({commit}, payload) {
		commit(_industries.SET_INDUSTRY_MAJOR, payload);
	}

};
