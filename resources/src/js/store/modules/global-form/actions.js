import _global from "../../mutation-types/global-form";

export default {
    setUniversity({commit}, payload){
        commit(_global.SET_UNIVERSITY, payload);
    },
    setDataPage({commit}, payload){
        commit(_global.SET_DATA_PAGE, payload);
    },
}