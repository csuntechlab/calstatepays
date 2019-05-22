const fetchFreDataAPI = (payload, success, error) => {
    window.axios.get(`api/pfre/${payload.education}/${payload.majorId}/${payload.earnings}/${payload.financialAid}`)
    .then(
        response => success(response.data),
    ).catch(
        failure=>{ error(failure.response.data)}
    );
}

export default {
    fetchFreDataAPI
}