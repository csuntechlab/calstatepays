const fetchFreDataAPI = (payload, success, error) => {
    console.log(payload);
    console.log(payload.major);
    window.axios.get(`api/major/${payload.major}/${payload.university}/${payload.age}/${payload.education}/${payload.earnings}/${payload.financialAid}`)
//, {
    // params: {
    //     'major':payload.major,
    //     'age_range': payload.age,
    //     'education_level': payload.education,
    //     'annual_earnings':  payload.earnings,
    //     'financial_aid': payload.financialAid,
    //     'university': state.university,
    // }
// })
    .then(
        response => success(response.data),
        response => error(response)
    );
}

export default {
    fetchFreDataAPI
}