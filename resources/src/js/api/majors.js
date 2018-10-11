
const fetchMajorsAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/university/${payload}`).then(
        response => success(response.data),
    ).catch(
        failure=>{ error(failure.response.data)}
    );
}

const fetchFieldOfStudiesAPI = (success, error) => {
    window.axios.get(`api/major/field-of-study`).then(
        response => success(response.data),
         
    ).catch(
        failure=>{ error(failure.response.data)}
    );
};

const fetchUpdatedMajorsByFieldAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/${payload.schoolId}/${payload.fieldOfStudyId}`).then(
        response => success(response.data),    
    ).catch(
        failure=>{ error(failure.response.data)}
    );
};

const fetchMajorDataAPI = (payload, success, error) => {
    window.axios.get(`api/major/${payload.majorId}/${payload.schoolId}`).then(
        // api / learn - and - earn / major - data / ${ payload.schoolId } / ${ payload.majorId }
        response => success(response.data),    
    ).catch(
        failure=>{ error(failure.response.data)}
    );
}

const fetchUniversitiesAPI = (success, error) => {
    window.axios.get(`api/university`).then(
        response => success(response.data), 
    ).catch(
        failure=>{ error(failure.response.data)}
    );
}
const fetchIndustryImagesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/${payload.majorId}/${payload.schoolId}`).then(
        response => success(response.data),   
    ).catch(
        failure=>{ error(failure.response.data)}
    );
};

export default {
    fetchMajorsAPI,
    fetchFieldOfStudiesAPI,
    fetchUpdatedMajorsByFieldAPI,
    fetchMajorDataAPI,
    fetchUniversitiesAPI,
    fetchIndustryImagesAPI
}