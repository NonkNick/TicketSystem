<script setup lang="ts">
import { RouterLink } from 'vue-router';
import TicketList from '@/views/components/TicketList.vue';
import AccountDetail from '@/views/components/AccountDetail.vue';
</script>

<template>
    <div class="flex h-full min-h-0 flex-col gap-4 p-4">
        <nav class="flex flex-col gap-2">
            <RouterLink to="/">Home</RouterLink>
            <RouterLink to="/about">About</RouterLink>
            <RouterLink to="/login">Login</RouterLink>
        </nav>

        <div class="min-h-0 flex-1 overflow-y-auto">
            <TicketList />
        </div>

        <AccountDetail />
    </div>
</template>

<style scoped></style>
