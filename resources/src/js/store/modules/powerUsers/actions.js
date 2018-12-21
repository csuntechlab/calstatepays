import PowerUsers from '../../../api/powerUser';
import _powerUsers from '../../mutation-types/powerUsers';
import _global from '../../mutation-types/global-form';


export default{
    setTableauValue({commit,dispatch},payload){
        commit(_powerUsers.TRIGGER_TABLEAU_IS_LOADING);
        PowerUsers.fetchPowerUserValue(payload,
            success =>{
                commit(_powerUsers.SET_TABLEAU_VALUE,success);
                commit(_powerUsers.TRIGGER_TABLEAU_IS_LOADING);
            },
            error =>{
                commit(_global.ERROR_ALERT,error)
            }
            
        );

    },

    fetchOptInValues({commit, dispatch}, payload) {
        PowerUsers.fetchOptInValuesAPI(
            (success)=> {
                console.log(`this is success ${success}`)
                commit(_powerUsers.FETCH_OPT_IN_VALUES,success);
            },
            (error) => commit(global.ERROR_ALERT,error)
        );
    }
}
