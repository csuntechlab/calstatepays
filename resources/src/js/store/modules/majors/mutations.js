//MAJORS MUTATIONS
import _majors from '../../mutation-types/majors';

export default {
    [_majors.FETCH_MAJORS](state, payload){
        console.log(payload);
        payload.forEach((college) => {
            state.majors.push(college.majors);
        });
    }
}