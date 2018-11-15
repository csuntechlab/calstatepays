const fetchIndustriesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/${payload.majorId}/${payload.university}`)
        .then(
            response => {
                success(response.data);
            },
            ).catch(
            failure=>{ 
                    if(failure.response.status == 400){
                        error(failure.response.data.major[0])
                    }else{
                        error(failure.response.data.message)
                    }

                }
        );
}
const fetchIndustryMajorsByFieldAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/${payload.schoolId}/${payload.fieldOfStudyId}`).then(
        response => success(response.data),
        response => error(response.data.message)
    );
};

export default {
    fetchIndustriesAPI,
    fetchIndustryMajorsByFieldAPI
}