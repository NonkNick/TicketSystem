<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Pencil, Trash2, X } from 'lucide-vue-next';
import { AxiosError } from 'axios';
import api from '@/lib/axios';
import { firstValidationMessage } from '@/lib/errors';
import TextInput from './TextInput.vue';
import SubmitButton from './SubmitButton.vue';
import type { Category } from '@/types';

const items = ref<Category[]>([]);
const error = ref('');

onMounted(async () => {
    const { data } = await api.get<{ data: Category[] }>('/categories');
    items.value = data.data;
});

const newName = ref('');
const submitting = ref(false);

async function addCategory(name: string) {
    submitting.value = true;
    error.value = '';
    try {
        const { data } = await api.post<{ data: Category }>('/categories', { name });
        items.value.push(data.data);
        newName.value = '';
    } catch (err) {
        error.value = firstValidationMessage(err) ?? 'Aanmaken mislukt.';
    } finally {
        submitting.value = false;
    }
}

const editingId = ref<number | null>(null);
const editName = ref('');
const editing = ref(false);

function startEdit(category: Category) {
    editingId.value = category.id;
    editName.value = category.name;
}

function cancelEdit() {
    editingId.value = null;
    editName.value = '';
}

async function saveEdit(categoryId: number, name: string) {
    editing.value = true;
    error.value = '';
    try {
        const { data } = await api.patch<{ data: Category }>(`/categories/${categoryId}`, { name });
        const index = items.value.findIndex((item) => item.id === categoryId);
        if (index !== -1) items.value[index] = data.data;
        cancelEdit();
    } catch (err) {
        error.value = firstValidationMessage(err) ?? 'Aanpassen mislukt.';
    } finally {
        editing.value = false;
    }
}

async function deleteCategory(category: Category) {
    if (!window.confirm(`Categorie "${category.name}" verwijderen?`)) return;
    error.value = '';
    try {
        await api.delete(`/categories/${category.id}`);
        items.value = items.value.filter((item) => item.id !== category.id);
    } catch (err) {
        // The API returns 409 when tickets are still linked to the category.
        error.value =
            err instanceof AxiosError && err.response?.status === 409
                ? 'Categorie heeft nog gekoppelde tickets en kan niet worden verwijderd.'
                : 'Verwijderen mislukt.';
    }
}
</script>

<template>
    <div class="flex flex-1 flex-col gap-3 card p-4">
        <h2 class="font-semibold text-content">Categorieën</h2>

        <p v-if="error" class="text-sm text-negative">{{ error }}</p>

        <p v-if="!items.length" class="text-sm text-content-subtle">Nog geen categorieën.</p>

        <ul v-else class="flex flex-col gap-2">
            <li v-for="category in items" :key="category.id" class="flex items-center gap-2">
                <div v-if="editingId === category.id" class="flex flex-1 items-end gap-2">
                    <TextInput
                        v-model="editName"
                        class="flex-1"
                        :rows="1"
                        :submitting="editing"
                        @submit="saveEdit(category.id, $event)"
                    />
                    <SubmitButton
                        :value="editName"
                        :submitting="editing"
                        @submit="saveEdit(category.id, $event)"
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

                <template v-else>
                    <span class="flex-1 text-content">{{ category.name }}</span>
                    <button
                        type="button"
                        aria-label="Categorie bewerken"
                        class="text-content-subtle hover:text-content"
                        @click="startEdit(category)"
                    >
                        <Pencil class="h-4 w-4" />
                    </button>
                    <button
                        type="button"
                        aria-label="Categorie verwijderen"
                        class="text-content-subtle hover:text-negative"
                        @click="deleteCategory(category)"
                    >
                        <Trash2 class="h-4 w-4" />
                    </button>
                </template>
            </li>
        </ul>

        <div class="flex items-end gap-2">
            <TextInput
                v-model="newName"
                class="flex-1"
                placeholder="Nieuwe categorie…"
                :rows="1"
                :submitting="submitting"
                @submit="addCategory"
            />
            <SubmitButton :value="newName" :submitting="submitting" @submit="addCategory" />
        </div>
    </div>
</template>

<style scoped></style>
