const fetchMajorDataAPI = (payload, success, error) => {
    window.axios.get(`api/major/${payload.form.majorId}/${payload.school}`).then(
        response => success(response.data),
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

const fetchIndustryImagesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/images/${payload.form.majorId}/${payload.school}`).then(
        response => {
        success(response.data)
    },   
    ).catch(
        failure=>{error(failure.response)}
    );
};

export default {
    fetchMajorDataAPI,
    fetchIndustryImagesAPI
}