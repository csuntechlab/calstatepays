import _powerUsers from '../../mutation-types/powerUsers';
import _majors from '../../mutation-types/majors';
import _global from '../../mutation-types/global-form';
import router from '../../../router'
export default{
    [_powerUsers.SET_TABLEAU_VALUE](state,payload){
        state.tableauValue = payload;
        router.push({name:'tableau' , params:{tableauValue:this.tableauValue}});
    },
    [_powerUsers.TRIGGER_TABLEAU_IS_LOADING](state) {
        if (state.tableauIsLoading===false) {
            state.tableauIsLoading = true;
        }
        else {
            state.tableauIsLoading = false;
        }
    },
    [_powerUsers.FETCH_OPT_IN_VALUES](state,payload) {
        console.log(`this is mutations ${payload}`)
        state.optInValues = payload;
    }
}