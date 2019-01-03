const fetchPowerUserTiles = (success, error) => {
    window.axios.get(`api/power/images`).then(
        response => success(response.data)
    ).catch(
        failure => error(failure.response)
    );
}
const fetchPowerUserValue = (payload,success,error) =>{
    window.axios.get(`api/power/${payload.university}/${payload.path_id}`).then(
        response =>success(response.data.iframe_string)
    ).catch(
        failure =>error(failure.response.data)
    );

}
const fetchOptInValuesAPI = (success, error) => {
    window.axios.get('api/power').then(
        response => success(response.data)
    ).catch(
        failure => error(failure.response.data)
    )
}

export default{
    fetchPowerUserValue,
    fetchOptInValuesAPI,
    fetchPowerUserTiles
}