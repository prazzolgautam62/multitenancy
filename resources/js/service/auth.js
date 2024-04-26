import axios from 'axios';
axios.defaults.baseURL = `${window.baseUrl}/api` 

function _login(data) {
    const url = `login`
    return axios.post(url, data).then(response => response.data)
}

export {
    _login
}