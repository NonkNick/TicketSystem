import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router';
import Home from '../views/Home.vue';
import About from '../views/About.vue';
import Login from "../views/Login.vue";
import api from '@/lib/axios'
import Register from "../views/Register.vue";
import AppLayout from "../layout/AppLayout.vue";

const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: AppLayout,
        meta: { requiresAuth: true },
        children: [
            {
                path: '',
                name: 'home',
                component: Home,
            },
            {
                path: 'about',
                name: 'about',
                component: About,
            },
        ],
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach(async (to) => {
    if (!to.meta.requiresAuth) {
        return true
    }

    try {
        await api.get('/user')
        return true
    } catch {
        return { name: 'login' }
    }
})

export default router