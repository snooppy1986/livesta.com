import axios from 'axios';
import router from './router/index'

const api = axios.create();

//start request
api.interceptors.request.use(config=>{
    if(localStorage.getItem('access_token')){
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`;
    }
    return config;
}, error=>{

});

//end request

//start response
api.interceptors.response.use(config=>{
    if(localStorage.getItem('access_token')){
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`;
    }
    return config;
}, error => {
    if(error.response.data.message === 'Token has expired'){
        return axios.post('/api/auth/refresh', {}, {
            headers:{
                'authorization' : `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then(res => {
            localStorage.setItem('access_token', res.data.access_token)
            error.config.headers.authorization = `Bearer ${res.data.access_token}`
            return api.request(error.config);
        })
    }
    //auth error
    if(error.response.status === 401){
        router.push({name: 'user.login'})
    }
    //role error
    if(error.response.status === 403){
        router.push({name: 'main'})
    }

    /*if(error.response.status === 422){
        return error;
    }*/
    return Promise.reject(error);
});
//end response

export default api;
