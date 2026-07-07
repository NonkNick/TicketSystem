import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import LoginView from '../views/LoginView.vue';
import { useAuthStore } from '@/stores/auth';
import RegisterView from '../views/RegisterView.vue';
import AppLayout from '../layout/AppLayout.vue';
import RootLayout from '../layout/RootLayout.vue';
import TicketDetailView from '@/views/TicketDetailView.vue';
import CreateTicketView from '@/views/CreateTicketView.vue';
import AdminView from '@/views/AdminView.vue';
import ForgotPasswordView from '@/views/ForgotPasswordView.vue';
import ResetPasswordView from '@/views/ResetPasswordView.vue';

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
                        path: '/tickets/create',
                        name: 'create-ticket',
                        component: CreateTicketView,
                    },
                    {
                        path: '/tickets/:id',
                        name: 'tickets',
                        component: TicketDetailView,
                    },
                    {
                        path: '/admin',
                        name: 'admin',
                        component: AdminView,
                        meta: { requiresAdmin: true },
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
            {
                path: '/forgot-password',
                name: 'forgot-password',
                component: ForgotPasswordView,
                meta: { guestOnly: true },
            },
            {
                path: '/reset-password/:token',
                name: 'reset-password',
                component: ResetPasswordView,
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
    if (!to.meta.requiresAuth && !to.meta.guestOnly && !to.meta.requiresAdmin) {
        return true;
    }

    const auth = useAuthStore();
    const isAuthenticated = (await auth.fetchUser()) !== null;

    if ((to.meta.requiresAuth || to.meta.requiresAdmin) && !isAuthenticated) {
        return { name: 'login' };
    }

    if (to.meta.guestOnly && isAuthenticated) {
        return { name: 'home' };
    }

    if (to.meta.requiresAdmin && !auth.isAdmin) {
        return { name: 'home' };
    }

    return true;
});

export default router;
