import axios from 'axios';

const fetchIndustryImagesAPI = (success, error) => {
    axios.get('/industry/22021/1153').then(
        response => success(response.data),
        response => error(response)
    );
};

export default {
    /*fetchIndustriesAPI,*/
    fetchIndustryImagesAPI,
}