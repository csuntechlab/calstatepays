const fetchMajorsAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/university/${payload}`).then(
        response => success(response.data),
    ).catch(
        failure=>{ 
                error(failure.response.data.message)
        }
    );
}
const fetchUniversitiesAPI = (success, error) => {
    window.axios.get(`api/university`).then(
        response => success(response.data)
    ).catch(
        failure=>error(failure.response.data.message)
    );
}
const fetchFieldOfStudiesAPI = (success, error) => {
    window.axios.get(`api/major/field-of-study`).then(
        response => success(response.data),
         
    ).catch(
        failure=>error(failure.response.data.message)
    );
};




export default{

    fetchMajorsAPI,
    fetchFieldOfStudiesAPI,
    fetchUniversitiesAPI 
}