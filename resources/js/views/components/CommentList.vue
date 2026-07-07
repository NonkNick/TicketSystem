<script setup lang="ts">
import { ref } from 'vue';
import { Pencil, X } from 'lucide-vue-next';
import api from '@/lib/axios';
import { useAuthStore } from '@/stores/auth';
import TextInput from './TextInput.vue';
import SubmitButton from './SubmitButton.vue';
import type { TicketComment } from '@/types';

const props = defineProps<{
    ticketId: number;
    comments: TicketComment[];
}>();

const emit = defineEmits<{
    added: [TicketComment];
    updated: [TicketComment];
}>();

const auth = useAuthStore();

// Add
const newMessage = ref('');
const adding = ref(false);

async function addComment(message: string) {
    adding.value = true;
    try {
        const { data } = await api.post<{ data: TicketComment }>(
            `/tickets/${props.ticketId}/comments`,
            { message },
        );
        emit('added', data.data);
        newMessage.value = '';
    } finally {
        adding.value = false;
    }
}

// Edit
const editingId = ref<number | null>(null);
const editMessage = ref('');
const saving = ref(false);

function startEdit(comment: TicketComment) {
    editingId.value = comment.id;
    editMessage.value = comment.message;
}

function cancelEdit() {
    editingId.value = null;
    editMessage.value = '';
}

async function saveEdit(commentId: number, message: string) {
    saving.value = true;
    try {
        const { data } = await api.patch<{ data: TicketComment }>(`/comments/${commentId}`, {
            message,
        });
        emit('updated', data.data);
        cancelEdit();
    } finally {
        saving.value = false;
    }
}

function formatDate(value: string) {
    return new Date(value).toLocaleString('nl-NL');
}
</script>

<template>
    <div class="flex flex-1 flex-col gap-3">
        <h2 class="font-semibold text-content">Reacties</h2>

        <p v-if="!comments.length" class="text-sm text-content-subtle">Nog geen reacties.</p>

        <ul v-else class="flex flex-col gap-3">
            <li v-for="comment in comments" :key="comment.id" class="flex card flex-col gap-1 p-4">
                <div class="flex items-center justify-between text-xs text-content-subtle">
                    <span>
                        {{ comment.user.name }} &middot; {{ formatDate(comment.created_at) }}
                        <span v-if="comment.edited_at" class="italic">(bewerkt)</span>
                    </span>
                    <button
                        v-if="auth.isAdmin && editingId !== comment.id"
                        type="button"
                        aria-label="Reactie bewerken"
                        class="text-content-subtle hover:text-content"
                        @click="startEdit(comment)"
                    >
                        <Pencil class="h-4 w-4" />
                    </button>
                </div>

                <div v-if="editingId === comment.id" class="flex items-end gap-2">
                    <TextInput
                        v-model="editMessage"
                        class="flex-1"
                        :submitting="saving"
                        @submit="saveEdit(comment.id, $event)"
                    />
                    <SubmitButton
                        :value="editMessage"
                        :submitting="saving"
                        @submit="saveEdit(comment.id, $event)"
                    />
                    <button
                        type="button"
                        aria-label="Annuleren"
                        class="rounded p-2 text-content-subtle hover:text-content"
                        @click="cancelEdit"
                    >
                        <X class="h-4 w-4" />
                    </button>
                </div>
                <p v-else class="text-sm whitespace-pre-wrap text-content">{{ comment.message }}</p>
            </li>
        </ul>

        <div v-if="auth.isAdmin" class="flex items-end gap-2 card p-4">
            <TextInput
                v-model="newMessage"
                class="flex-1"
                placeholder="Reactie toevoegen…"
                :submitting="adding"
                @submit="addComment"
            />
            <SubmitButton :value="newMessage" :submitting="adding" @submit="addComment" />
        </div>
    </div>
</template>

<style scoped></style>
