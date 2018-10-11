const fetchIndustriesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/${payload.majorId}/${payload.university}`)
        .then(
            response => success(response.data),
            ).catch(
            failure=>{ error(failure.response.data)}
        );
}

export default {
    fetchIndustriesAPI
}