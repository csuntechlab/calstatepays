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
    [_global.FETCH_MAJORS](state, payload){
        state.majors=[];
        payload.forEach((major) => {
            major.majorId = major.hegis_code;
            delete major.hegis_code;
            state.majors.push(major);
        });
    },
    [_global.FETCH_FIELD_OF_STUDIES](state, payload){
        state.fieldOfStudy = [];
        payload.forEach((fieldOfStudy) => {
            fieldOfStudy.discipline = fieldOfStudy.name;
            delete fieldOfStudy.name;
            state.fieldOfStudy.push(fieldOfStudy);
        });
    },
    [_global.FETCH_UNIVERSITIES](state, payload) {
        payload.forEach((university) => {
            university.name = university.university_name;
            delete university.university_name;
            state.universities.push(university);
        });
    },


}