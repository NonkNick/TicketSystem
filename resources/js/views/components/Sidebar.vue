<script setup lang="ts">
import TicketList from '@/views/components/TicketList.vue';
import AccountDetail from '@/views/components/AccountDetail.vue';
</script>

<template>
    <div class="flex h-full min-h-0 flex-col pt-4">

        <div class="min-h-0 flex-1 overflow-y-auto px-4 py-4">
            <TicketList />
        </div>

        <AccountDetail />
    </div>
</template>

<style scoped></style>
