import { createRouter, createWebHistory } from 'vue-router';
import defaultRoutes from './default';
import main from './main';
import tenant from './tenant';

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

export default router;
