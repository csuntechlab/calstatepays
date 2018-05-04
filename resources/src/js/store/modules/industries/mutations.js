//MAJORS MUTATIONS
import _industries from '../../mutation-types/industries';

export default {
    [_industries.FETCH_INDUSTRY_IMAGES](state, payload) {
        state.industries = payload;
    }
}