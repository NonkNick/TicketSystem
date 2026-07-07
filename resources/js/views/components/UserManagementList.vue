<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue';
import { Pencil, Trash2, X } from 'lucide-vue-next';
import { AxiosError } from 'axios';
import api from '@/lib/axios';
import { firstValidationMessage } from '@/lib/errors';
import TextInput from './TextInput.vue';
import SubmitButton from './SubmitButton.vue';
import type { User, UserRole } from '@/types';

const items = ref<User[]>([]);
const error = ref('');

onMounted(async () => {
    const { data } = await api.get<{ data: User[] }>('/users');
    items.value = data.data;
});

const editingId = ref<number | null>(null);
const saving = ref(false);
const draft = reactive({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    role: 'user' as UserRole,
});

function startEdit(user: User) {
    editingId.value = user.id;
    error.value = '';
    draft.first_name = user.first_name ?? '';
    draft.last_name = user.last_name ?? '';
    draft.email = user.email ?? '';
    draft.phone = user.phone ?? '';
    draft.role = user.role;
}

function cancelEdit() {
    editingId.value = null;
}

async function saveUser(userId: number) {
    saving.value = true;
    error.value = '';
    try {
        const { data } = await api.put<{ data: User }>(`/users/${userId}`, { ...draft });
        const index = items.value.findIndex((item) => item.id === userId);
        if (index !== -1) items.value[index] = data.data;
        cancelEdit();
    } catch (err) {
        error.value = firstValidationMessage(err) ?? 'Aanpassen mislukt.';
    } finally {
        saving.value = false;
    }
}

async function deleteUser(user: User) {
    if (!window.confirm(`Gebruiker "${user.name}" verwijderen?`)) return;
    error.value = '';
    try {
        await api.delete(`/users/${user.id}`);
        items.value = items.value.filter((item) => item.id !== user.id);
    } catch (err) {
        error.value =
            err instanceof AxiosError && err.response?.status === 409
                ? err.response.data.message
                : 'Verwijderen mislukt.';
    }
}
</script>

<template>
    <div class="flex flex-col gap-3 card p-4">
        <h2 class="font-semibold text-content">Gebruikers</h2>

        <p v-if="error" class="text-sm text-negative">{{ error }}</p>

        <table class="w-full text-left text-sm">
            <thead class="text-content-subtle">
                <tr>
                    <th class="py-2 pr-3 font-medium">Voornaam</th>
                    <th class="py-2 pr-3 font-medium">Achternaam</th>
                    <th class="py-2 pr-3 font-medium">E-mailadres</th>
                    <th class="py-2 pr-3 font-medium">Rol</th>
                    <th class="py-2 pr-3 font-medium">Telefoonnummer</th>
                    <th class="py-2 font-medium">Acties</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="user in items"
                    :key="user.id"
                    class="border-t border-border align-top text-content"
                >
                    <template v-if="editingId === user.id">
                        <td class="py-2 pr-3">
                            <TextInput v-model="draft.first_name" :rows="1" :submitting="saving" />
                        </td>
                        <td class="py-2 pr-3">
                            <TextInput v-model="draft.last_name" :rows="1" :submitting="saving" />
                        </td>
                        <td class="py-2 pr-3">
                            <TextInput v-model="draft.email" :rows="1" :submitting="saving" />
                        </td>
                        <td class="py-2 pr-3">
                            <select
                                v-model="draft.role"
                                :disabled="saving"
                                class="
                                    rounded border border-border px-2 py-2 text-content
                                    focus:border-accent focus:outline-none
                                    disabled:opacity-50
                                "
                            >
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </td>
                        <td class="py-2 pr-3">
                            <TextInput v-model="draft.phone" :rows="1" :submitting="saving" />
                        </td>
                        <td class="py-2">
                            <div class="flex items-center gap-2">
                                <SubmitButton :submitting="saving" @submit="saveUser(user.id)" />
                                <button
                                    type="button"
                                    aria-label="Annuleren"
                                    class="rounded p-2 text-content-subtle hover:text-content"
                                    @click="cancelEdit"
                                >
                                    <X class="h-4 w-4" />
                                </button>
                            </div>
                        </td>
                    </template>

                    <template v-else>
                        <td class="py-2 pr-3">{{ user.first_name }}</td>
                        <td class="py-2 pr-3">{{ user.last_name }}</td>
                        <td class="py-2 pr-3">{{ user.email }}</td>
                        <td class="py-2 pr-3">{{ user.role }}</td>
                        <td class="py-2 pr-3">{{ user.phone }}</td>
                        <td class="py-2">
                            <div class="flex items-center gap-2">
                                <button
                                    type="button"
                                    aria-label="Gebruiker bewerken"
                                    class="text-content-subtle hover:text-content"
                                    @click="startEdit(user)"
                                >
                                    <Pencil class="h-4 w-4" />
                                </button>
                                <button
                                    type="button"
                                    aria-label="Gebruiker verwijderen"
                                    class="text-content-subtle hover:text-negative"
                                    @click="deleteUser(user)"
                                >
                                    <Trash2 class="h-4 w-4" />
                                </button>
                            </div>
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped></style>
