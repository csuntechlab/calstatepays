// MAJORS GETTERS

export default {
    majors: state => state.majors,
    majorById: (state) => (id) => {
        const index = state.majors.findIndex((major) => major.majorId === Number(id));
        return state.majors[index];
    },
    majorData: state => state.majorData,
    majorDataByMajorId: (state, getters) => (id) => {
        const index = getters.majorData.findIndex(dataSet => dataSet.majorId == id);
        return getters.majorData[index];
    },
    industries: state => index => state.majorCards[index].industries,
    universities: state => state.universities,
    universityById: (state, getters) => (id) => {
        const index = getters.universities.findIndex(campus => campus.id == id);
        return getters.universities[index];
    },
    majorCards: state => state.majorCards,
}