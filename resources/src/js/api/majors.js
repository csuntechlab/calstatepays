const fetchMajorsAPI = (success, error) => {
    window.axios.get('api/major/hegis-codes').then(
        response => success(response.data),
        response => error(response)
    );
}
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

export default {
    fetchMajorsAPI,
    fetchMajorDataAPI,
    fetchUniversitiesAPI,
}