import axios from 'axios';

const fetchIndustriesAPI = (success, error) => {
    axios.get('api/learn-and-earn/industry/1/information').then(
        response => success(response.data),
        response => error(response)
    );
};

const fetchIndustryImagesAPI = (success, error) => {
    axios.get('/industry/22021/1153').then(
        response => success(response.data),
        response => error(response)
    );
};

export default {
    fetchIndustriesAPI,
    fetchIndustryImagesAPI,
}