// PFRE MUTATIONS
import _pfre from '../../mutation-types/pfre';

export default {
	[_pfre.FETCH_MOCK_DATA](state) {
		state.pfreData.years.actual = Math.floor(
			Math.random() * Math.floor(13)
		);
		state.pfreData.earnings.actual = Math.floor(
			Math.random() * Math.floor(45000)
		);
		state.pfreData.returnOnInvestment.actual = (
			Math.random() * (0 - 0.15) +
			0.15
		).toFixed(2);
    },
    [_pfre.FETCH_PFRE_MAJORS_BY_FIELD](state, payload) {
        state.pfreMajorsByField = payload[0]

    },
    [_pfre.SET_DISCIPLINE_LOAD](state, payload) {
        state.pfreDisciplineLoad = payload
    },
	[_pfre.FETCH_FRE_DATA](state, payload) {
        state.pfreData.returnOnInvestment = payload
    },
    
    [_pfre.TRIGGER_IS_LOADING](state) {
        if (state.pfreIsLoading === false) {
            state.pfreIsLoading = true;
        } else {
            state.pfreIsLoading = false;
        }
    },

	[_pfre.TOGGLE_INFO](state, payload) {
		if (!state.pfreShowInfo) {
			state.pfreInfoKey = payload;
			state.pfreShowInfo = true;
		} else {
			if (state.pfreInfoKey == payload) {
				state.pfreShowInfo = false;
			} else {
				state.pfreInfoKey = payload;
			}
		}
    },

    [_pfre.SUBMIT_PFRE](state) {
        state.pfreFormWasSubmitted = true;
    },
    
	[_pfre.RESET_FRE_STATE](state, payload) {
		state.pfreData.returnOnInvestment = '';
    },
    
    [_pfre.SET_PFRE](state, payload){
        state.pfreSelected.majorName = payload.majorName.major;
        state.pfreSelected.earnings = payload.earnings.earn;
        state.pfreSelected.financialAid = payload.financialAid.finAid;

        if(payload.education === 'FTF')
            state.pfreSelected.education = 'Freshman';
        else if(payload.education === 'FTT')
            state.pfreSelected.education = 'Transfer';
    }
};