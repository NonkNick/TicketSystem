<script setup lang="ts">
import { computed } from 'vue';
import type { Ticket, TicketStatus } from '../../types';

const props = defineProps<{ ticket: Ticket }>();

const statusLabels: Record<TicketStatus, string> = {
    in_afwachting: 'In afwachting',
    in_behandeling: 'In behandeling',
    afgehandeld: 'Afgehandeld',
};

const statusLabel = computed(() => statusLabels[props.ticket.status]);
</script>

<template>
    <RouterLink class="flex flex-col gap-2 card p-4" :to="`/tickets/${ticket.id}`">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-content-subtle">#{{ ticket.id }}</span>
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
            <span v-if="ticket.assignee">Toegewezen aan: {{ ticket.assignee.name }}</span>
            <span v-else class="italic">Niet toegewezen</span>
        </div>
    </RouterLink>
</template>

<style scoped></style>
