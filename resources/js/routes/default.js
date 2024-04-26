import Login from '../components/auth/Login.vue'

const defaultRoutes = [
    {
        path: '/',
        name: 'login',
        component: Login,
        meta: {
            title: 'Login',
            require_auth: false,
            permission: ''
        }
    },
]
export default defaultRoutes