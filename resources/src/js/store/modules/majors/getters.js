// MAJORS GETTERS

export default {
    majors: state => state.majors,
    universities: state => state.universities,
    majorData: state => state.majorData,
    majorById: (state) => (id) => {
        const index = state.majors.findIndex(major => major.majorId === id);
        return state.majors[index];
    },
}