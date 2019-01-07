import PowerUsers from '../../../api/powerUser';
import _powerUsers from '../../mutation-types/powerUsers';
import _global from '../../mutation-types/global-form';


export default{
    setTableauValue({commit,dispatch},payload){
        commit(_powerUsers.SET_TABLEAU_VALUE, payload);
    },
    fetchOptInValues({commit, dispatch}, payload) {
        PowerUsers.fetchOptInValuesAPI(
            (success)=> {
                commit(_powerUsers.FETCH_OPT_IN_VALUES,success);
            },
            (error) => commit(global.ERROR_ALERT,error)
        );
    }
}
