//MAJORS MUTATIONS
import _majors from '../../mutation-types/majors';

export default {
    [_majors.FETCH_MAJORS](state, payload){
        payload.forEach((major) => {
            major.majorId = major.hegis_code;
            delete major.hegis_code;
            state.majors.push(major);
        });
    },

    [_majors.FETCH_MAJOR_DATA](state, payload) {
       state.majorData.push(payload);
    },

    [_majors.FETCH_UNIVERSITIES](state, payload) {
        payload.forEach((university) => {
            university.name = university.university_name;
            delete university.university_name;
            state.universities.push(university);
        }); 
    },

    [_majors.ADD_MAJOR_CARD](state) {
        state.majorCards.push({
            majorData: []
        });
    }

}