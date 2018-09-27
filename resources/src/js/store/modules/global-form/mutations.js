import _global from "../../mutation-types/global-form";

export default {
    [_global.SET_UNIVERSITY](state,payload){
        state.selectedUniversity = payload;
    },
    [_global.SET_DATA_PAGE](state, payload){
        state.selectedDataPage = payload;
    },
    [_global.SET_MODAL_CHECK](state, payload){
        state.modalCheck = payload;
    }

}