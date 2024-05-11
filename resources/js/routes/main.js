import Home from '../components/main/Home.vue'
import Index from '../components/main/tenant/Index.vue'

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
    {
        path: '/tenants',
        name: 'tenants',
        component: Index,
        meta: {
            title: 'Tenants',
            permission: ''
        }
    },

    {
        path: '/email',
        name: 'email',
        component: Index,
        meta: {
            title: 'Email',
            permission: ''
        }
    },
]
mainRoutes.forEach(route => {
    route.meta.require_auth = true
    route.meta.is_tenant = false
})
export default mainRoutes