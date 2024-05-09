import Home from '../components/tenant/Home.vue'

const tenantRoutes = [
    {
        path: "/home",
        name: "home",
        component: Home,
        meta: {
            title: "Home",
            permission: ""
        }
    },

]
tenantRoutes.forEach(route => {
    route.meta.require_auth = true
    route.meta.is_tenant = true
})
export default tenantRoutes