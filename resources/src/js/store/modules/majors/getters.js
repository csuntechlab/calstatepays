// MAJORS GETTERS

export default {
    majors: state => state.majors,
    majorById: (state) => (id) => {
        const index = state.majors.findIndex((major) => major.majorId === Number(id));
        return state.majors[index];
    },
    majorNameById: (state, getters) => id => {
        const major = getters.majorById(id);
        return major.major;
    },
    majorData: state => index => state.majorCards[index].majorData,
    industries: state => index => state.majorCards[index].industries,
    educationLevel: state => index => state.majorCards[index].educationLevel,
    universities: state => state.universities,
    fieldOfStudies: state => state.fieldOfStudy,
    universityById: (state, getters) => (id) => {
        const index = getters.universities.findIndex(campus => campus.id == id);
        return getters.universities[index];
    },
    majorCards: state => state.majorCards,
    majorsByField: state => index => state.majorCards[index].majorsByField,
    formWasSubmitted:state=> index => state.majorCards[index].formWasSubmitted,
    previousFormsWereSubmitted: state => {
        return state.majorCards.every(function(el) {
            return el.formWasSubmitted === true;
        })
    }
}