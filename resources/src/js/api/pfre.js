const fetchFreDataAPI = (payload, success, error) => {
    window.axios.get(`api/major/${payload.majorId}/${payload.university}/${payload.age}/${payload.education}/${payload.earnings}/${payload.financialAid}`)
    .then(
        response => success(response.data),
    ).catch(
        failure=>{ error(failure.response.data)}
    );
}

export default {
    fetchFreDataAPI
}