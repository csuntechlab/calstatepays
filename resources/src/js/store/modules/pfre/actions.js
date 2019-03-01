// PFRE ACTIONS
import Pfre from '../../../api/pfre';
import Industries from '../../../api/industries';
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
            (error) => console.error(error),
        );
    },

    fetchPfreMajorsByField({ commit, dispatch }, payload) {
        commit(_pfre.SET_DISCIPLINE_LOAD, true);
        Industries.fetchIndustryMajorsByFieldAPI(
            payload,
            (success) => {
                commit(_pfre.FETCH_PFRE_MAJORS_BY_FIELD, success);
                commit(_pfre.SET_DISCIPLINE_LOAD, false);
            },
            (error) => commit(_global.ERROR_ALERT, error)
        );
    },

    toggleInfo({commit}, payload) {
        commit(_pfre.TOGGLE_INFO, payload);
    },

    submitPfreForm({commit}){
        commit(_pfre.SUBMIT_PFRE);
    },

    resetFreState({commit}){
        commit(_pfre.RESET_FRE_STATE);
    },

    setPfreSelections({commit}, payload){
        commit(_pfre.SET_PFRE, payload);
    }
}