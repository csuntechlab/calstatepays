const fetchMajorsAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/university/${payload}`).then(
        response => success(response.data),
        response => error(response)
    );
}

const fetchFieldOfStudiesAPI = (success, error) => {
    window.axios.get(`api/major/field-of-study`).then(
        response => success(response.data),
        response => error(response)
    );
};

const fetchUpdatedMajorsByFieldAPI = (payload, success, error) => {
    window.axios.get(`api/major/hegis-codes/${payload.schoolId}/${payload.fieldOfStudyId}`).then(
        response => success(response.data),
        response => error(response)
    );
};

const fetchMajorDataAPI = (payload, success, error) => {
    window.axios.get(`api/major/${payload.majorId}/${payload.schoolId}`).then(
        // api / learn - and - earn / major - data / ${ payload.schoolId } / ${ payload.majorId }
        response => success(response.data),
        response => error(response)
    );
}

const fetchUniversitiesAPI = (success, error) => {
    window.axios.get(`api/university`).then(
        response => success(response.data),
        response => error(response)
    );
}
const fetchIndustryImagesAPI = (payload, success, error) => {
    window.axios.get(`api/industry/images/${payload.majorId}/${payload.schoolId}`).then(
        response => success(response.data),
        response => error(response)
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