<script setup lang="ts">
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const router = useRouter();
const auth = useAuthStore();

async function logout() {
    await auth.logout();
    router.push({ name: 'login' });
}
</script>

<template>
    <div
        class="
            flex items-center justify-between gap-2 bg-surface p-4
            shadow-[0_-6px_16px_-6px_rgba(0,0,0,0.35)]
        "
    >
        <button
            type="button"
            class="
                rounded border border-border px-3 py-1 text-sm text-positive
                hover:bg-surface-hover
            "
            @click="router.push({ name: 'create-ticket' })"
        >
            Create Ticket
        </button>

        <button
            v-if="auth.isAdmin"
            type="button"
            class="
                rounded border border-border px-3 py-1 text-sm text-content
                hover:bg-surface-hover
            "
            @click="router.push({ name: 'admin' })"
        >
            Admin
        </button>

        <button
            type="button"
            class="
                rounded border border-border px-3 py-1 text-sm text-negative
                hover:bg-surface-hover
            "
            @click="logout"
        >
            Uitloggen
        </button>
    </div>
</template>

<style scoped></style>
