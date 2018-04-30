import axios from 'axios';
const fetchMajorsAPI = (success, error) => {
    axios.get('api/learn-and-earn/major-data/1153').then(
        response => success(response.data),
        response => error(response)
    );
}
const fetchMajorDataAPI = (payload, success, error) => {
    axios.get(`api/learn-and-earn/major-data/${payload.schoolId}/${payload.majorId}`).then(
        response => success(response.data),
        response => error(response)
    );
}

export default {
    fetchMajorsAPI,
    fetchMajorDataAPI
}