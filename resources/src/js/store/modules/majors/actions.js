//MAJORS ACTIONS
import Major from '../../../api/majors';
import _majors from '../../mutation-types/majors';

export default {

    fetchMajors({commit, dispatch}, payload){
        Major.fetchMajorsAPI(
            payload,
            (success) => {
                commit(_majors.FETCH_MAJORS, success);
            },
            (error) => console.log(error),
        );
    },

    fetchFieldOfStudies({commit, dispatch},payload){
        Major.fetchFieldOfStudiesAPI(
            (success) => {
                commit(_majors.FETCH_FIELD_OF_STUDIES, success);
            },
            (error) => console.log(error),
        );
    },

    clearMajorSelection({commit}){
                commit(_majors.RESET_MAJOR_SELECTIONS);
    },

    fetchUpdatedMajorsByField({ commit, dispatch }, payload) {
        Major.fetchUpdatedMajorsByFieldAPI(
            payload,
            (success) => {
                success.cardIndex = payload.cardIndex;
                commit(_majors.FETCH_UPDATED_MAJORS_BY_FIELD, success);
            },
            (error) => console.log(error),
        );
    },

    fetchUniversities({ commit, dispatch }) {
        Major.fetchUniversitiesAPI(
            (success) => {
                commit(_majors.FETCH_UNIVERSITIES, success);
            },
            (error) => console.log(error),
        );
    },

    fetchMajorData({ commit, dispatch }, payload) {
        Major.fetchMajorDataAPI(
            payload,
            (success) => {
                success.cardIndex = payload.cardIndex;
                commit(_majors.FETCH_MAJOR_DATA, success);
            },
            (error) => console.log(error),
        );
    },

    fetchIndustryImages({ commit, dispatch }, payload) {
        Major.fetchIndustryImagesAPI(
            payload,
            (success) => {
                success.cardIndex = payload.cardIndex;
                success.forEach((industry) => industry['majorId'] = payload.majorId);
                commit(_majors.FETCH_INDUSTRY_IMAGES, success);
            },
            (error) => console.log(error),
        );
    }, 

    toggleEducationLevel({commit}, payload) {
        commit(_majors.TOGGLE_EDUCATION_LEVEL, payload);
    },

    toggleFormWasSubmitted({commit}, payload){
        commit(_majors.TOGGLE_FORM_WAS_SUBMITTED, payload)
    },

    addMajorCard({commit}) {
        commit(_majors.ADD_MAJOR_CARD);
    },

    deleteMajorCard({commit}, payload) {
        commit(_majors.DELETE_MAJOR_CARD,payload);
    },

    resetMajorCard({commit}, payload) {
        commit(_majors.RESET_MAJOR_CARD,payload);
    },
}