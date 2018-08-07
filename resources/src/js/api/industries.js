const fetchIndustriesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/${payload.majorId}/${payload.university}`)
        .then(
            response => success(response.data),
            response => error(response)
        );
}

export default {
    fetchIndustriesAPI
}