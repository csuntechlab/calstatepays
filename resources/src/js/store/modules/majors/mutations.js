//MAJORS MUTATIONS
import _majors from '../../mutation-types/majors';

export default {
    [_majors.FETCH_UPDATED_MAJORS_BY_FIELD](state, payload) {
        let index = payload.cardIndex;
        state.majorCards[index].majorsByField = payload[0];
    },

    [_majors.FETCH_MAJOR_DATA](state, payload) {
        console.log("SUCCESS - fetch major data - mutation - payload", payload)
        console.log("SUCCESS - fetch major data - mutation - state", state)
        console.log("SUCCESS - fetch major data - mutation - payload.cardIndex", payload.cardIndex)
        if(payload.cardIndex===undefined)payload.cardIndex =0
        let index = payload.cardIndex;
        console.log("SUCCESS - fetch major data - mutation - index", index)
        console.log("SUCCESS - fetch major data - mutation - state.majorCards[0]", state.majorCards[index])
        state.majorCards[index].majorData = payload;
    },

    [_majors.SET_DISCIPLINE_LOAD](state, payload) {
        let index = payload.cardIndex;
        state.majorCards[index].majorDisciplineLoad = payload.status;
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
        if (payload == undefined) payload = 0
        console.log("Submitted Majors form - mutation")
        console.log(payload, "majors mutation toggle form payload")

        let index = payload;
        state.majorCards[index].formWasSubmitted = true;
        state.majorCards[index].submittedOnce = true;
        state.industryFormWasSubmitted = true;
		state.industryFormWasSubmittedOnce = true;
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
        console.log("trigger major is loading - mutation payload")
        var index;
        if(payload.cardIndex ===undefined) {
            if(payload.form.cardIndex===undefined) payload.form.cardIndex = 0
            index = payload.form.cardIndex
            console.log("major is loading - mutation index", index)
        }
        else {
            index = payload.cardIndex;
        }

        if (!state.majorCards[index].majorIsLoading) {
            state.majorCards[index].majorIsLoading = true;
        } else if (state.majorCards[index].majorIsLoading) {
            if(state.majorCards[index].majorData.majorId === payload.majorId) {
                state.majorCards[index].majorIsLoading= false;
            }
            else if(payload.majorId===undefined) {
                state.majorCards[index].majorIsLoading= true;
            }
        }
    }
}