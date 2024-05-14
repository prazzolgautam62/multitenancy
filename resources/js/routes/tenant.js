import Home from '../components/tenant/Home.vue'
import Configuration from '../components/tenant/Configuration.vue'

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
    {
        path: "/configuration",
        name: "configuration",
        component: Configuration,
        meta: {
            title: "Configuration",
            permission: ""
        }
    },

]
tenantRoutes.forEach(route => {
    route.meta.require_auth = true
    route.meta.is_tenant = true
})
export default tenantRoutes