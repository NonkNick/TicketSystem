<script setup lang="ts">
import { ref, watch } from 'vue';
import { Pencil, Trash2, X } from 'lucide-vue-next';
import api from '@/lib/axios';
import TextInput from './TextInput.vue';
import SubmitButton from './SubmitButton.vue';
import type { Note } from '@/types';

const props = defineProps<{
    ticketId: number;
    notes: Note[];
}>();

const items = ref<Note[]>([]);
watch(
    () => props.notes,
    (notes) => {
        items.value = [...notes];
    },
    { immediate: true },
);

const newNote = ref('');
const submitting = ref(false);

async function addNote(note: string) {
    submitting.value = true;
    try {
        const { data } = await api.post<{ data: Note }>(`/tickets/${props.ticketId}/notes`, {
            note,
        });
        items.value.push(data.data);
        newNote.value = '';
    } finally {
        submitting.value = false;
    }
}

const editingId = ref<number | null>(null);
const editText = ref('');
const editing = ref(false);

function startEdit(note: Note) {
    editingId.value = note.id;
    editText.value = note.note;
}

function cancelEdit() {
    editingId.value = null;
    editText.value = '';
}

async function saveEdit(noteId: number, note: string) {
    editing.value = true;
    try {
        const { data } = await api.patch<{ data: Note }>(`/notes/${noteId}`, { note });
        const index = items.value.findIndex((item) => item.id === noteId);
        if (index !== -1) items.value[index] = data.data;
        cancelEdit();
    } finally {
        editing.value = false;
    }
}

async function removeNote(noteId: number) {
    if (!window.confirm('Notitie verwijderen?')) return;
    await api.delete(`/notes/${noteId}`);
    items.value = items.value.filter((item) => item.id !== noteId);
}

function formatDate(value: string) {
    return new Date(value).toLocaleString('nl-NL');
}
</script>

<template>
    <div class="flex min-w-1/3 flex-col gap-3 p-4">
        <h2 class="font-semibold text-content">Notities</h2>

        <p v-if="!items.length" class="text-sm text-content-subtle">Nog geen notities.</p>

        <ul v-else class="flex flex-col gap-3 ">
            <li v-for="note in items" :key="note.id" class="flex flex-col gap-1 card p-4">
                <div class="flex items-center justify-between text-xs text-content-subtle">
                    <span>{{ note.user.name }} &middot; {{ formatDate(note.created_at) }}</span>
                    <div v-if="editingId !== note.id" class="flex items-center gap-2">
                        <button
                            type="button"
                            aria-label="Notitie bewerken"
                            class="text-content-subtle hover:text-content"
                            @click="startEdit(note)"
                        >
                            <Pencil class="h-4 w-4" />
                        </button>
                        <button
                            type="button"
                            aria-label="Notitie verwijderen"
                            class="text-content-subtle hover:text-negative"
                            @click="removeNote(note.id)"
                        >
                            <Trash2 class="h-4 w-4" />
                        </button>
                    </div>
                </div>

                <div v-if="editingId === note.id" class="flex items-end gap-2">
                    <TextInput
                        v-model="editText"
                        class="flex-1"
                        :submitting="editing"
                        @submit="saveEdit(note.id, $event)"
                    />
                    <SubmitButton
                        :value="editText"
                        :submitting="editing"
                        @submit="saveEdit(note.id, $event)"
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
                <p v-else class="text-sm whitespace-pre-wrap text-content">{{ note.note }}</p>
            </li>
        </ul>

        <div class="flex items-end gap-2 card p-4">
            <TextInput
                v-model="newNote"
                class="flex-1"
                placeholder="Notitie toevoegen…"
                :submitting="submitting"
                @submit="addNote"
            />
            <SubmitButton :value="newNote" :submitting="submitting" @submit="addNote" />
        </div>
    </div>
</template>

<style scoped></style>
