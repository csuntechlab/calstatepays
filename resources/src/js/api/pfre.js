const fetchFreDataAPI = (payload, success, error) => {
    let encodedMajor = encodeURIComponent(payload.major)
    window.axios.post(`api/pfre/${payload.education}/${payload.earnings}/${payload.financialAid}`, {'major': encodedMajor })
    .then(
        response => success(response.data.pfre),
    ).catch(
        failure=>{
            error(failure)
        }
    );
}

export default {
    fetchFreDataAPI
}