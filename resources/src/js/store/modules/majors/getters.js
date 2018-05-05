// MAJORS GETTERS

export default {
    majors: state => state.majors,
    majorById: (state) => (id) => {
        const index = state.majors.findIndex((major) => major.majorId === id);
        return state.majors[index];
    },
    majorData: state => state.majorData,
    universities: state => state.universities,

    universityById: (state, getters) => (id) => {
        const index = getters.universities.findIndex(campus => campus.id == id);
        return getters.universities[index];
    },
}