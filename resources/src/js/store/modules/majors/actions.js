//MAJORS ACTIONS
import Major from '../../../api/majors';
export default{

    getMajorData({commit, dispatch}){
        Major.getMajorsAPI(
            (success) => {
                console.log(success);
            },
            (error) => console.log(error),
        );
    }
    
}