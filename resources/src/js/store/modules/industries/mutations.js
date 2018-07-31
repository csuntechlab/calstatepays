import _industries from "../../mutation-types/industries";

export default {
    [_industries.FETCH_INDUSTRIES](state,payload){
        payload.forEach((industry) => {
            delete industry.image;
            state.industries.push(industry);
        });
    }
}