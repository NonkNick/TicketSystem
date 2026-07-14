<script setup lang="ts">
import { computed, ref } from 'vue';
import { Pencil, X } from 'lucide-vue-next';
import { storeToRefs } from 'pinia';
import { isAxiosError } from 'axios';
import type { Ticket, TicketStatus, User } from '@/types';
import AdminAssign from './AdminAssign.vue';
import TicketFormFields from './TicketFormFields.vue';
import api, { csrf } from '../../lib/axios';
import { useAuthStore } from '@/stores/auth';
import { useCategoryStore } from '@/stores/categories';

const props = defineProps<{ ticket: Ticket }>();
const emit = defineEmits<{ updated: [Ticket] }>();

const authStore = useAuthStore();
const { isAdmin } = storeToRefs(authStore);
const categoryStore = useCategoryStore();
const { all: allCategories } = storeToRefs(categoryStore);
const assignee = ref<User | null>(props.ticket.assignee);

const canEdit = computed(() => isAdmin.value || authStore.user?.id === props.ticket.creator.id);

const editing = ref(false);
const editTitle = ref('');
const editDescription = ref('');
const editCategoryIds = ref<number[]>([]);
const editStatus = ref<TicketStatus>('in_afwachting');
const errors = ref<Record<string, string[]>>({});
const submitting = ref(false);

async function startEdit() {
    editTitle.value = props.ticket.title;
    editDescription.value = props.ticket.description;
    editCategoryIds.value = props.ticket.categories.map((c) => c.id);
    editStatus.value = props.ticket.status;
    errors.value = {};

    if (!allCategories.value.length) {
        await categoryStore.getAll();
    }

    editing.value = true;
}

function cancelEdit() {
    editing.value = false;
    errors.value = {};
}

async function save() {
    submitting.value = true;
    errors.value = {};

    try {
        await csrf();
        const { data } = await api.patch<{ data: Ticket }>(`/tickets/${props.ticket.id}`, {
            title: editTitle.value,
            description: editDescription.value,
            categories: editCategoryIds.value,
            ...(isAdmin.value ? { status: editStatus.value } : {}),
        });
        emit('updated', data.data);
        editing.value = false;
    } catch (e) {
        if (isAxiosError(e) && e.response?.status === 422) {
            errors.value = e.response.data.errors ?? {};
        } else {
            errors.value = { title: ['Er ging iets mis. Probeer het later opnieuw.'] };
        }
    } finally {
        submitting.value = false;
    }
}

async function unassign() {
    await api.patch(`/tickets/${props.ticket.id}`, { assigned_to: null });
    assignee.value = null;
}

const statusLabels: Record<TicketStatus, string> = {
    in_afwachting: 'In afwachting',
    in_behandeling: 'In behandeling',
    afgehandeld: 'Afgehandeld',
};

const statusLabel = computed(() => statusLabels[props.ticket.status]);
</script>

<template>
    <div v-if="editing" class="flex flex-col gap-3 card p-4">
        <TicketFormFields
            v-model:title="editTitle"
            v-model:description="editDescription"
            v-model:category-ids="editCategoryIds"
            :categories="allCategories"
            :errors="errors"
        />

        <div v-if="isAdmin" class="flex flex-col gap-1">
            <label class="text-sm font-medium text-content-muted" for="ticket-status">Status</label>
            <select
                id="ticket-status"
                v-model="editStatus"
                class="
                    rounded border border-border px-3 py-2 text-content
                    focus:border-accent focus:outline-none
                "
            >
                <option v-for="(label, value) in statusLabels" :key="value" :value="value">
                    {{ label }}
                </option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <button
                type="button"
                :disabled="submitting"
                class="
                    rounded bg-primary px-3 py-2 text-white
                    hover:bg-primary-hover
                    disabled:opacity-50
                "
                @click="save"
            >
                {{ submitting ? 'Bezig…' : 'Opslaan' }}
            </button>
            <button
                type="button"
                :disabled="submitting"
                class="
                    rounded border border-border px-3 py-2 text-content
                    hover:bg-surface-hover
                    disabled:opacity-50
                "
                @click="cancelEdit"
            >
                Annuleren
            </button>
        </div>
    </div>

    <div v-else class="flex flex-col gap-2 card p-4">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-content-subtle">#{{ ticket.id }}</span>
            <div class="flex items-center gap-2">
                <span
                    class="rounded-full px-2 py-0.5 text-xs font-semibold"
                    :class="{
                        'bg-warning-soft text-warning': ticket.status === 'in_afwachting',
                        'bg-info-soft text-info': ticket.status === 'in_behandeling',
                        'bg-positive-soft text-positive': ticket.status === 'afgehandeld',
                    }"
                >
                    {{ statusLabel }}
                </span>
                <button
                    v-if="canEdit"
                    type="button"
                    aria-label="Ticket bewerken"
                    class="rounded-full hover:text-accent"
                    @click.prevent.stop="startEdit"
                >
                    <Pencil class="h-4 w-4" />
                </button>
            </div>
        </div>

        <p class="font-semibold text-content">{{ ticket.title }}</p>
        <p class="line-clamp-2 text-sm text-content-muted">{{ ticket.description }}</p>

        <div v-if="ticket.categories.length" class="flex flex-wrap gap-1">
            <span
                v-for="category in ticket.categories"
                :key="category.id"
                class="color-positive card bg-info-soft px-2 py-0.5 text-xs text-content-muted"
            >
                {{ category.name }}
            </span>
        </div>

        <div class="flex items-center justify-between text-xs text-content-subtle">
            <span>Aangemaakt door: {{ ticket.creator.name }}</span>
            <template v-if="isAdmin">
                <span v-if="assignee" class="flex flex-row items-center gap-1">
                    <span>Toegewezen aan: {{ assignee.name }}</span>
                    <X class="cursor-pointer hover:text-negative" @click.prevent.stop="unassign" />
                </span>
                <span v-else class="italic" @click.prevent.stop>
                    <AdminAssign :ticket-id="ticket.id" @assigned="assignee = $event" />
                </span>
            </template>
            <template v-else>
                <span v-if="assignee">Toegewezen aan: {{ assignee.name }}</span>
                <span v-else class="italic">Niet toegewezen</span>
            </template>
        </div>
    </div>
</template>

<style scoped></style>
