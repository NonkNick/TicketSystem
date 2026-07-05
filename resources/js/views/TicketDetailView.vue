<script setup lang="ts">
import { useRoute } from 'vue-router';
import { ref, watch } from 'vue';
import TicketDetail from '@/views/components/TicketDetail.vue';
import NoteList from '@/views/components/NoteList.vue';
import api from '@/lib/axios';
import type { Ticket } from '@/types';

const route = useRoute();
const ticket = ref<Ticket | null>(null);

watch(
    () => route.params.id, // ① what to watch: the id, live
    async (id) => {
        // ② runs whenever it changes
        const { data: body } = await api.get<{ data: Ticket }>(`/tickets/${id}`);
        ticket.value = body.data;
    },
    { immediate: true }, // ③ also run once right away
);
</script>

<template>
    <div class="flex flex-row gap-y-4">
        <TicketDetail v-if="ticket" :ticket="ticket" />
        <NoteList></NoteList>
    </div>
</template>

<style scoped></style>
