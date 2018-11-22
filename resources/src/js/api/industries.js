const fetchIndustriesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/${payload.form.majorId}/${payload.school}`)
        .then(
            response => {
                success(response.data);
            },
            ).catch(
            failure=>{ 
                error(failure.response.data)}
        );
}
const fetchIndustryMajorsByFieldAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/${payload.school}/${payload.form.fieldOfStudyId}`).then(
        response => success(response.data),
        response => error(response)
    );
};

export default {
    fetchIndustriesAPI,
    fetchIndustryMajorsByFieldAPI
}