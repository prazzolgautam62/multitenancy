import axios from 'axios';
import { useUserStore } from '../../store/user';
axios.defaults.baseURL = `${window.baseUrl}/api` ;

function getAccessToken() {
    const userStore = useUserStore();
    return userStore.getAccessToken;
}

async function _getTenants() {
    return await axios.get('tenant', {
        headers: { 'Authorization': getAccessToken() }
    }).then(response => response.data)
}

function _storeTenant(data) {
    return axios.post('tenant', data, {
        headers: { 'Authorization': getAccessToken() }
    }).then(response => response.data)
}

export {
    _getTenants,
    _storeTenant
}