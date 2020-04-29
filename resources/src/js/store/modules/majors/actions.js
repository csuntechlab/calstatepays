//MAJORS ACTIONS
import Major from '../../../api/majors';
import _majors from '../../mutation-types/majors';
import _industries from "../../mutation-types/industries"
import _global from '../../mutation-types/global-form';
export default {
    majorNameById: (state, getters) => id => {
        const major = getters.majorById(id);
        return major.major;
    },

    clearMajorSelection({commit}){
        commit(_majors.RESET_MAJOR_SELECTIONS);
    },
    fetchUpdatedMajorsByField({ commit, dispatch }, payload) {
        commit(_majors.SET_DISCIPLINE_LOAD, {status: true, cardIndex: payload.form.cardIndex});
        Major.fetchUpdatedMajorsByFieldAPI(
            payload,
            (success) => {
                success.cardIndex = payload.form.cardIndex;
                commit(_majors.FETCH_UPDATED_MAJORS_BY_FIELD, success);
                commit(_majors.SET_DISCIPLINE_LOAD, { status: false, cardIndex: payload.form.cardIndex });
            },
            (error) => commit(_global.ERROR_ALERT, { message: 'Oops! Major data unavailable' }),
        );
    },
    fetchMajorData({ commit, dispatch }, payload) {
        commit(_majors.TRIGGER_MAJOR_IS_LOADING, payload);
        Major.fetchMajorDataAPI(
            payload,
            (success) => {
                success.cardIndex = payload.form.cardIndex;
                commit(_majors.FETCH_MAJOR_DATA, success);
                commit(_majors.TRIGGER_MAJOR_IS_LOADING, success);
            },
            (error) => commit(_global.ERROR_ALERT,error),
        );
    },
    fetchIndustryImages({ commit }, payload) {
        Major.fetchIndustryImagesAPI(
            payload,
            (success) => {
                success.cardIndex = payload.form.cardIndex;
                commit(_majors.FETCH_INDUSTRY_IMAGES,{ industries:success.bachelors,cardIndex:success.cardIndex});
            },
            (error) => commit(_global.ERROR_ALERT,error),
        );
    }, 

    toggleEducationLevel({commit}, payload) {
        commit(_majors.TOGGLE_EDUCATION_LEVEL, payload);
    },

    toggleFormWasSubmitted({commit}, payload){
        commit(_majors.TOGGLE_FORM_WAS_SUBMITTED, payload)
        commit(_industries.TOGGLE_INDUSTRY_FORM_WAS_SUBMITTED)
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

    resetMajorState({commit}){
        commit(_majors.RESET_MAJOR_STATE);
    }
}