// PFRE ACTIONS
import Pfre from '../../../api/pfre';
import _pfre from '../../mutation-types/pfre';


export default {

    fetchMockData({commit, dispatch}) {
        commit(_pfre.FETCH_MOCK_DATA);
    },

    fetchFreData({commit, dispatch}, payload){
        Pfre.fetchFreDataAPI(
            payload,
            (success) => {   
                commit(_pfre.FETCH_FRE_DATA, success);
            },
            (error) => console.log(error),
        );
    },

    toggleInfo({commit}, payload) {
        commit(_pfre.TOGGLE_INFO, payload);
    },

    submitPfreForm({commit}){
        commit(_.pfre.SUBMIT_PFRE);
    },

    resetFreState({commit}){
        commit(_pfre.RESET_FRE_STATE);
    }
}