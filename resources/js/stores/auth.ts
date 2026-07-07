import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import api, { csrf } from '@/lib/axios';
import type { User } from '@/types';

export const useAuthStore = defineStore('auth', () => {
    const user = ref<User | null>(null);

    async function fetchUser(): Promise<User | null> {
        try {
            const { data } = await api.get<{ data: User }>('/user');
            user.value = data.data;
        } catch {
            user.value = null;
        }
        return user.value;
    }

    async function logout(): Promise<void> {
        await csrf(); // fresh
        await api.post('/logout');
        user.value = null;
    }

    const isAdmin = computed(() => user.value?.role === 'admin');

    return { user, isAdmin, fetchUser, logout };
});
