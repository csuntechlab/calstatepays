const fetchFreDataAPI = (payload, success, error) => {
    window.axios.get(`api/major/${payload.form.majorId}/${payload.school}/${payload.form.age}/${payload.form.education}/${payload.form.earnings}/${payload.form.financialAid}`)
    .then(
        response => success(response.data),
    ).catch(
        failure=>{ error(failure.response.data)}
    );
}

export default {
    fetchFreDataAPI
}