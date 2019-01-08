import _global from "../../mutation-types/global-form";
import Global from '../../../api/global';

export default {
    setUniversity({commit}, payload){
        commit(_global.SET_UNIVERSITY, payload);
    },
    setDataPage({commit}, payload){
        commit(_global.SET_DATA_PAGE, payload);
    },
    setError({commit},payload){
        commit(_global.ERROR_ALERT,payload);
    },
    fetchMajors({commit, dispatch}, payload){
        Global.fetchMajorsAPI(
            payload,
            (success) => {
                commit(_global.FETCH_MAJORS, success);
            },
            (error) =>{
                commit(_global.ERROR_ALERT,error)  
            }
        );
    },
    fetchUniversities({ commit, dispatch }) {
        Global.fetchUniversitiesAPI(
            (success) => {
                commit(_global.FETCH_UNIVERSITIES, success);
            },
            (error) => commit(_global.ERROR_ALERT,error),
        );
    },
    fetchFieldOfStudies({commit, dispatch},payload){
        Global.fetchFieldOfStudiesAPI(
            (success) => {
                commit(_global.FETCH_FIELD_OF_STUDIES, success);
            },
            (error) => commit(_global.ERROR_ALERT,error),
        );
    },
    
}