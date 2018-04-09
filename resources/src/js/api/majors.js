import axios from 'axios';
const getMajorsAPI = (success, error) => {
    axios.get('api/learn-and-earn/major-data/1153').then(
        response => success(response.data),
        response => error(response)
    );
}

export default {
    getMajorsAPI
}