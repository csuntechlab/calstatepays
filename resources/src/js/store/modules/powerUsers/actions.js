import PowerUsers from '../../../api/powerUser';
import _powerUrsers from '../../mutation-types/powerUsers';
import _global from '../../mutation-types/global-form';


export default{
    setTableauValue({commit,dispatch},payload){
        PowerUsers.fetchPowerUserValue(payload,
            success =>{
                commit(_powerUrsers.SET_TABLEAU_VALUE,success)
            },
            error =>{
                commit(_global.ERROR_ALERT,error)
            }
            
        );

    }
}
