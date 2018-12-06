const fetchPowerUserValue = (payload,success,error) =>{
    window.axios.get(`api/power/${payload.university}/${payload.path_id}`).then(
        response =>success(response.data.iframe_string)
    ).catch(
        failure =>error(failure.response.data)
    );

}
export default{
    fetchPowerUserValue
}