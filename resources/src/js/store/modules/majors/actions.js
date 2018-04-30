//MAJORS ACTIONS
import Major from '../../../api/majors';
import _majors from '../../mutation-types/majors';

export default{

    fetchMajors({commit, dispatch}){
        Major.fetchMajorsAPI(
            (success) => {
                commit(_majors.FETCH_MAJORS, success);
            },
            (error) => console.log(error),
        );
    },

    fetchMajorData({ commit, dispatch }, payload) {
        Major.fetchMajorDataAPI(
            payload,
            (success) => {
                commit(_majors.FETCH_MAJOR_DATA, success);
            },
            (error) => console.log(error),
        );
    }
    
}