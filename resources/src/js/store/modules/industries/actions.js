//MAJORS ACTIONS
import Industry from '../../../api/industries';
import _industries from '../../mutation-types/industries';

export default {

    fetchIndustries({ commit, dispatch }) {
        Industry.fetchIndustriesAPI(
            (success) => {
                commit(_industries.FETCH_INDUSTRIES, success);
            },
            (error) => console.log(error),
        );
    }

}