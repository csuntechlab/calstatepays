import _global from "../../mutation-types/global-form";

export default {
    [_global.SET_UNIVERSITY](state,payload){
        state.selectedUniversity = payload;
    }

}