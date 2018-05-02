//MAJORS MUTATIONS
import _majors from '../../mutation-types/majors';

export default {
    [_majors.FETCH_MAJORS](state, payload){
        payload.forEach((major) => {
            console.log(major);
            delete major.hegis_code;
            state.majors.push(major);
        });
    },

    [_majors.FETCH_MAJOR_DATA](state, payload) {
        payload.forEach((dataSet) => state.majorData.push(dataSet));
    },

    [_majors.FETCH_UNIVERSITIES](state, payload) {
        payload.forEach((university) => {
            university.name = university.university_name;
            delete university.university_name;
            state.universities.push(university);
        }); 
    },


}