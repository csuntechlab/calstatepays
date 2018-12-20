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

    }
}
