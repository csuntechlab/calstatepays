import _industries from "../../mutation-types/industries";

export default {
	[_industries.FETCH_INDUSTRIES](state, payload) {
		state.allLevelIndustries = payload;
		state.industries = payload[state.industryEducationLevel];
	},
	// TODO: ZANE fix this 
	[_industries.FETCH_INDUSTRY_MAJORS_BY_FIELD](state, payload) {
		state.industryMajorsByField = payload[0]

	},
	[_industries.RESET_INDUSTRY_STATE](state) {
		state.industries = [];
		state.industryMajorsByField = [];
		state.industryFormWasSubmitted = false;
		state.industryFormWasSubmittedOnce = false;
		state.industryMajor = null;
	},
	[_industries.RESET_INDUSTRY_CARD](state) {
		if (state.industryFormWasSubmitted) {
			state.industryFormWasSubmitted = false;
		} else {
			state.industryFormWasSubmitted = true;
		}
	},
	[_industries.TOGGLE_INDUSTRY_FORM_WAS_SUBMITTED](state, payload) {
		state.industryFormWasSubmitted = true;
		state.industryFormWasSubmittedOnce = true;
	},
	[_industries.TOGGLE_INDUSTRY_EDUCATION_LEVEL](state, payload) {
		state.industryEducationLevel = payload;
		state.industries = state.allLevelIndustries[payload];
	},
	[_industries.SET_INDUSTRY_MAJOR](state, payload) {
		state.industryMajorId = payload.majorId
		state.industryMajor = payload.major;
	},
	[_industries.TRIGGER_IS_LOADING](state, payload) {
		if(!state.industryIsLoading) {
			state.industryIsLoading = true;
		}
		else if (state.industryIsLoading) {
			if(state.industryMajorId===payload.major_id){
				state.industryIsLoading = false;
			}
			else if (payload.major_id === undefined) {
				state.industryIsLoading = true;
			}
			
		}
	}
};