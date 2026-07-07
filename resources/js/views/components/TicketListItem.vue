<script setup lang="ts">
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import type { Ticket, TicketStatus } from '@/types';

const props = defineProps<{ ticket: Ticket }>();

const router = useRouter();

const dateFormat = new Intl.DateTimeFormat('nl-NL', {
    day: 'numeric',
    month: 'numeric',
    year: 'numeric',
});
function formatDate(value: string) {
    return dateFormat.format(new Date(value));
}

const statusLabels: Record<TicketStatus, string> = {
    in_afwachting: 'In afwachting',
    in_behandeling: 'In behandeling',
    afgehandeld: 'Afgehandeld',
};

const statusLabel = computed(() => statusLabels[props.ticket.status]);
</script>

<template>
    <tr
        class="
            cursor-pointer border-b border-border text-content transition-colors
            last:border-b-0
            hover:bg-surface-hover
        "
        @click="router.push(`/tickets/${ticket.id}`)"
    >
        <td class="px-2 py-2 text-xs whitespace-nowrap text-content-subtle/70">#{{ ticket.id }}</td>
        <td class="w-full max-w-0 truncate px-2 py-2 font-medium" :title="ticket.title">
            {{ ticket.title }}
        </td>
        <td class="px-2 py-2">
            <div v-if="ticket.categories.length" class="flex flex-wrap gap-1">
                <span
                    v-for="category in ticket.categories"
                    :key="category.id"
                    class="
                        rounded bg-neutral-soft px-2 py-0.5 text-xs whitespace-nowrap
                        text-content-muted
                    "
                >
                    {{ category.name }}
                </span>
            </div>
            <span v-else class="text-content-subtle">—</span>
        </td>
        <td class="px-2 py-2">
            <span
                class="rounded-full px-2 py-0.5 text-xs font-semibold whitespace-nowrap"
                :class="{
                    'bg-warning-soft text-warning': ticket.status === 'in_afwachting',
                    'bg-info-soft text-info': ticket.status === 'in_behandeling',
                    'bg-positive-soft text-positive': ticket.status === 'afgehandeld',
                }"
            >
                {{ statusLabel }}
            </span>
        </td>
        <td class="px-2 py-2 whitespace-nowrap">{{ ticket.creator.name }}</td>
        <td class="px-2 py-2 whitespace-nowrap text-content-subtle">
            <span>{{ formatDate(ticket.created_at) }}</span>
            <span
                v-if="ticket.updated_at !== ticket.created_at"
                class="block text-xs text-content-subtle/70"
            >
              {{ formatDate(ticket.updated_at) }}*
            </span>
        </td>
    </tr>
</template>

<style scoped></style>
