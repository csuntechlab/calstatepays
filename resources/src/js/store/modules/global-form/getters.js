// Global form getters
export default {
    selectedUniversity: state => state.selectedUniversity,
    selectedDataPage: state => state.selectedDataPage,
    errorMessage: state => state.errorMessage,
    
    majors: state => state.majors,
    majorById: (state) => (id) => {
        const index = state.majors.findIndex((major) => major.majorId === Number(id));
        return state.majors[index];
    },
    majorNameById: (state, getters) => id => {
        const major = getters.majorById(id);
        return major.major;

    },
    universities: state =>state.universities,
    fieldOfStudies: state => state.fieldOfStudy,
    universityById: (state, getters) => (id) => {
        const index = getters.universities.findIndex(campus => campus.id == id);
        return getters.universities[index];
    },
}