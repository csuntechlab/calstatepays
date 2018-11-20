import _industries from "../../mutation-types/industries";

export default {
	[_industries.FETCH_INDUSTRIES](state, payload) {
		state.allLevelIndustries = payload;
		state.industries = payload[state.industryEducationLevel];
	},
	[_industries.FETCH_INDUSTRY_MAJORS_BY_FIELD](state,payload) {
		state.industryMajorsByField = [];
		payload[0].forEach(major => {
			major.majorId = major.hegisCode;
			delete major.hegisCode;
			state.industryMajorsByField.push(major);
		});
	},
	[_industries.RESET_INDUSTRY_STATE](state) {
		state.industries = [];
		state.industryMajorsByField = [];
	},
	[_industries.RESET_INDUSTRY_CARD](state) {
		if(state.industryFormWasSubmitted) {
			state.industryFormWasSubmitted = false;
		}
		else {
			state.industryFormWasSubmitted = true;
		}
	},
	[_industries.TOGGLE_INDUSTRY_FORM_WAS_SUBMITTED](state, payload) {
		state.industryFormWasSubmitted = true;
		state.industryFormWasSubmittedOnce = true;
	},
	[_industries.TOGGLE_INDUSTRY_EDUCATION_LEVEL](state,payload) {
		state.industryEducationLevel = payload;
		state.industries = state.allLevelIndustries[payload];
	},
	[_industries.SET_INDUSTRY_MAJOR](state, payload) {
		state.industryMajor = payload.major;
	}
};
