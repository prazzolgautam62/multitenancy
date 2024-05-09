import Home from '../components/main/Home.vue'

const mainRoutes = [
    {
        path: '/admin',
        name: 'admin',
        component: Home,
        meta: {
            title: 'Admin',
            permission: ''
        }
    },

]
mainRoutes.forEach(route => {
    route.meta.require_auth = true
    route.meta.is_tenant = false
})
export default mainRoutes