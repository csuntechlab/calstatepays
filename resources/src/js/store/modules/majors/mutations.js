//MAJORS MUTATIONS
import _majors from '../../mutation-types/majors';

export default {
    [_majors.FETCH_UPDATED_MAJORS_BY_FIELD](state, payload) {
        let index = payload.cardIndex;
        state.majorCards[index].majorsByField = payload[0];
    },

    [_majors.FETCH_MAJOR_DATA](state, payload) {
        let index = payload.cardIndex;
        state.majorCards[index].majorData = payload;
    },

    [_majors.RESET_MAJOR_SELECTIONS](state) {
        state.majors = [];
    },
    
    [_majors.FETCH_INDUSTRY_IMAGES](state, payload) {
        let index = payload.cardIndex;
        state.majorCards[index].industries = payload.industries;

    },

    [_majors.TOGGLE_EDUCATION_LEVEL](state, payload) {
        let index = payload.cardIndex;
        state.majorCards[index].educationLevel = payload.educationLevel;
    },

    [_majors.TOGGLE_FORM_WAS_SUBMITTED](state, payload) {
        let index = payload;
        state.majorCards[index].formWasSubmitted = true;
        state.majorCards[index].submittedOnce = true;
    },
    [_majors.ADD_MAJOR_CARD](state) {
        state.majorCards.push({
            majorsByField: [],
            educationLevel: 'allDegrees',
            industries: [],
            majorData: [],
            formWasSubmitted: false,
            submittedOnce: false,
            majorIsLoading: false
        });
    },

    [_majors.DELETE_MAJOR_CARD](state, payload) {
        let index = payload;
        if (index !== 0) {
            state.majorCards.splice(index, 1);
        }
    },

    [_majors.RESET_MAJOR_CARD](state, payload) {
        let index = payload;
        if (state.majorCards[index].formWasSubmitted === true) {
            state.majorCards[index].formWasSubmitted = false;
        } else {
            state.majorCards[index].formWasSubmitted = true;
        }
    },
    [_majors.RESET_MAJOR_STATE](state) {
        state.majorCards = [{
            formWasSubmitted: false,
            submittedOnce: false,
            majorsByField: [],
            industries: [],
            majorData: [],
            majorIsLoading: false,
            educationLevel: 'allDegrees'
        }];
    },
    [_majors.TRIGGER_MAJOR_IS_LOADING](state, payload) {
        let index = payload;
        if (state.majorCards[index].majorIsLoading === false) {
            state.majorCards[index].majorIsLoading = true;
        } else {
            state.majorCards[index].majorIsLoading = false;
        }
    }
}