//MAJORS ACTIONS
import Major from '../../../api/majors';
import _majors from '../../mutation-types/majors';
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
        Major.fetchUpdatedMajorsByFieldAPI(
            payload,
            (success) => {
                success.cardIndex = payload.form.cardIndex;
                commit(_majors.FETCH_UPDATED_MAJORS_BY_FIELD, success);
            },
            (error) => commit(_global.ERROR_ALERT, { message: 'Oops! Major data unavailable' }),
        );
    },
    fetchMajorData({ commit, dispatch }, payload) {
        commit(_majors.TRIGGER_MAJOR_IS_LOADING, payload.form.cardIndex);
        Major.fetchMajorDataAPI(
            payload,
            (success) => {
                success.cardIndex = payload.form.cardIndex;
                commit(_majors.FETCH_MAJOR_DATA, success);
                commit(_majors.TRIGGER_MAJOR_IS_LOADING, success.cardIndex);
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