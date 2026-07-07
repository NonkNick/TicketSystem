<script setup lang="ts">
import { useRoute } from 'vue-router';
import { ref, watch } from 'vue';
import TicketDetail from '@/views/components/TicketDetail.vue';
import CommentList from '@/views/components/CommentList.vue';
import NoteList from '@/views/components/NoteList.vue';
import api from '@/lib/axios';
import { useAuthStore } from '@/stores/auth';
import type { Ticket, TicketComment } from '@/types';

const route = useRoute();
const auth = useAuthStore();
const ticket = ref<Ticket | null>(null);

watch(
    () => route.params.id,
    async (id) => {
        const { data: body } = await api.get<{ data: Ticket }>(`/tickets/${id}`);
        ticket.value = body.data;
    },
    { immediate: true },
);

function applyUpdate(updated: Ticket) {
    if (ticket.value) ticket.value = { ...ticket.value, ...updated };
}

function addComment(comment: TicketComment) {
    if (ticket.value) ticket.value.comments = [...(ticket.value.comments ?? []), comment];
}

function updateComment(updated: TicketComment) {
    if (!ticket.value?.comments) return;
    ticket.value.comments = ticket.value.comments.map((comment) =>
        comment.id === updated.id ? updated : comment,
    );
}
</script>

<template>
    <div v-if="ticket" class="flex flex-row gap-4 py-4 pr-4">
        <div class="flex flex-1 flex-col gap-4">
            <TicketDetail :ticket="ticket" @updated="applyUpdate" />
            <CommentList
                :ticket-id="ticket.id"
                :comments="ticket.comments ?? []"
                @added="addComment"
                @updated="updateComment"
            />
        </div>
        <NoteList class="w-1/5"
            v-if="auth.isAdmin" :ticket-id="ticket.id" :notes="ticket.notes ?? []" />
    </div>
</template>

<style scoped></style>
