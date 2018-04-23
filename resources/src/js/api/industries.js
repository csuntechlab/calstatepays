import axios from 'axios';
const fetchIndustriesAPI = (success, error) => {
    axios.get('api/learn-and-earn/industry/1/information').then(
        response => success(response.data),
        response => error(response)
    );
};

const fetchIndustryImageAPI = (success, error) => {
    axios.get('/industry/2201/1153').then(
        response => success(response.data),
        response => error(response)
    );
}

export default {
    fetchIndustriesAPI
}