import axios from 'axios';
import { useUserStore } from '../store/user';
axios.defaults.baseURL = `${window.baseUrl}/api` ;

function getAccessToken() {
    const userStore = useUserStore();
    return userStore.getAccessToken;
}

async function _login(data) {
    const url = `login`
    return await axios.post(url, data).then(response => response.data)
}

async function _logout() {
    return await axios.post('logout', {}, {
        headers: { 'Authorization': getAccessToken() }
    }).then(response => response.data)
}

export {
    _login,
    _logout
}