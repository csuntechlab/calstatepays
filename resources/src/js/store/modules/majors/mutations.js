//MAJORS MUTATIONS
import _majors from '../../mutation-types/majors';

export default {
    [_majors.FETCH_MAJORS](state, payload){
        state.majors = payload;
    },

    [_majors.FETCH_MAJOR_DATA](state, payload) {
        payload.forEach((dataSet) => state.majorData.push(dataSet));
    },

}