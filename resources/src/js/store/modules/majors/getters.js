// MAJORS GETTERS

export default {
    majors: state => state.majors,
    majorData: state => state.majorData,
    majorById: (state) => (id) => {
        const index = state.majors.findIndex(major => major.majorId === id);
        return state.majors[index];
    },
}