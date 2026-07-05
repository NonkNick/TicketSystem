import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import LoginView from '../views/LoginView.vue';
import api from '@/lib/axios';
import RegisterView from '../views/RegisterView.vue';
import AppLayout from '../layout/AppLayout.vue';
import RootLayout from '../layout/RootLayout.vue';
import TicketDetailView from '@/views/TicketDetailView.vue';

const routes: RouteRecordRaw[] = [
    {
        path: '',
        component: RootLayout,
        children: [
            {
                path: '',
                component: AppLayout,
                meta: { requiresAuth: true },
                children: [
                    {
                        path: '/',
                        name: 'home',
                        component: HomeView,
                    },
                    {
                        path: '/about',
                        name: 'about',
                        component: AboutView,
                    },
                    {
                        path: '/tickets/:id',
                        name: 'tickets',
                        component: TicketDetailView,
                    },
                ],
            },
            {
                path: '/login',
                name: 'login',
                component: LoginView,
                meta: { guestOnly: true },
            },
            {
                path: '/register',
                name: 'register',
                component: RegisterView,
                meta: { guestOnly: true },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to) => {
    if (!to.meta.requiresAuth && !to.meta.guestOnly) {
        return true;
    }

    const isAuthenticated = await api.get('/user').then(
        () => true,
        () => false,
    );

    if (to.meta.requiresAuth && !isAuthenticated) {
        return { name: 'login' };
    }

    if (to.meta.guestOnly && isAuthenticated) {
        return { name: 'home' };
    }

    return true;
});

export default router;
