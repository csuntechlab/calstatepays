import _global from "../../mutation-types/global-form";

export default {
    [_global.SET_UNIVERSITY](state,payload){
        state.selectedUniversity = payload;
    },
    [_global.SET_DATA_PAGE](state, payload){
        state.selectedDataPage = payload;
    },
    [_global.ERROR_ALERT](state,payload){
        state.errorMessage = payload;
    },
    [_global.FETCH_MAJORS](state, payload) {
        state.majors = payload
    },
    [_global.FETCH_UNIVERSITIES](state, payload) {
        state.universities = payload;
    },
    [_global.FETCH_FIELD_OF_STUDIES](state, payload) {
        state.fieldOfStudy = payload
    },
}