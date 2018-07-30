import _global from "../../mutation-types/global-form";

export default {
    setUniversity({commit}, payload){
        commit(_global.SET_UNIVERSITY, payload);
    }
}