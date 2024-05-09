import { createRouter, createWebHistory } from 'vue-router';
import defaultRoutes from './default';
import main from './main';
import tenant from './tenant';
import { useUserStore } from '../store/user';

let __base = '/';

const routes = [
    ...defaultRoutes,
    ...main,
    ...tenant
];

const router = createRouter({
    history: createWebHistory(__base),
    routes,
    scrollBehavior() {
        return { x: 0, y: 0 };
    }
});

router.beforeEach((to, from, next)=>{
    const userStore = useUserStore();
    if(to.name == 'login'){
        if(userStore.isAuth){
            next({ name: userStore.typeAdmin ? 'admin' : 'home' })
            return
        }
        next()
        return
    }
    else {
        if (to.meta.require_auth) {
            if (userStore.isAuth) {
                const isTenant = to.meta.is_tenant
                if (isTenant === false) {
                    userStore.typeAdmin ? next() : next({ name: 'home' })
                } else if (isTenant === true) {
                   userStore.normalUser ? next() : next({ name: 'admin' })
                }
                next()
                return
            } else {
                next({ name: 'login' })
                return
            }
        }
    }
    next()
    return
})

export default router;
