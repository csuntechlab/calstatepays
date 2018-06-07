// PFRE MUTATIONS
import _pfre from '../../mutation-types/pfre';

export default {
    [_pfre.FETCH_MOCK_DATA](state) {
        state.pfreData.years.actual = Math.floor(Math.random() * Math.floor(13));
        state.pfreData.earnings.actual = Math.floor(Math.random() * Math.floor(45000));
        state.pfreData.returnOnInvestment.actual = (Math.random() * (0 - .15) + .15).toFixed(2);
    },

    [_pfre.FETCH_FRE_DATA](state, payload) {
        state.pfreData.years = payload.timeToDegree;
        state.pfreData.earnings = payload.earningsYearFive;
        state.pfreData.returnOnInvestment = payload.returnOnInvestment;
    },

    [_pfre.TOGGLE_INFO] (state, payload){
        if(!state.pfreShowInfo){
            state.pfreInfoKey = payload;
            state.pfreShowInfo = true;
        } else{
            if(state.pfreInfoKey == payload){
                state.pfreShowInfo = false;
            } else {
                state.pfreInfoKey = payload;
            }
        }
    }
}