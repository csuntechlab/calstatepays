//MAJORS ACTIONS
import Industry from '../../../api/industries';
import _industries from '../../mutation-types/industries';

export default {

    fetchIndustryImages({commit, dispatch},payload) {
        Industry.fetchIndustryImagesAPI(
            payload,
            (success) => {
                success.forEach((industry) => industry['majorId'] = payload.majorId);
                commit(_industries.FETCH_INDUSTRY_IMAGES, success);
            },
            (error) => console.log(error),
        );
    }

}