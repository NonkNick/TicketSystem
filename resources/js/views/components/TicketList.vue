<script setup lang="ts">
import { onMounted, ref } from 'vue';
import api from '../../lib/axios';
import TicketListItem from './TicketListItem.vue';
import type { Ticket } from '@/types';

const tickets = ref<Ticket[]>([]);

onMounted(async () => {
    const { data: body } = await api.get<{ data: Ticket[] }>('/tickets');
    tickets.value = body.data;
    console.log(tickets.value);
});
</script>

<template>
    <div class="flex flex-col gap-4">
        <TicketListItem v-for="ticket in tickets" :key="ticket.id" :ticket="ticket" />
    </div>
</template>

<style scoped></style>
