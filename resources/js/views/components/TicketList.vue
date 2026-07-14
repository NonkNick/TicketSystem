<script setup lang="ts">
import { onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import TicketListItem from './TicketListItem.vue';
import { useTicketStore } from '@/stores/tickets';

const ticketStore = useTicketStore();
const { all: tickets } = storeToRefs(ticketStore);

onMounted(() => ticketStore.getAll());
</script>

<template>
    <div class="overflow-hidden card">
        <div class="overflow-y-auto">
            <table class="w-full border-collapse text-left text-sm">
                <thead>
                    <tr
                        class="
                            border-b border-border text-xs font-medium tracking-wide
                            text-content-subtle uppercase
                        "
                    >
                        <th class="px-2 py-2">ID</th>
                        <th class="w-full px-2 py-2">Titel</th>
                        <th class="px-2 py-2">Cat.</th>
                        <th class="px-2 py-2">Status</th>
                        <th class="px-2 py-2 whitespace-nowrap">door</th>
                        <th class="px-2 py-2 whitespace-nowrap">Datum</th>
                    </tr>
                </thead>
                <tbody>
                    <TicketListItem v-for="ticket in tickets" :key="ticket.id" :ticket="ticket" />
                    <tr v-if="!tickets.length">
                        <td class="px-3 py-6 text-center text-content-subtle" colspan="6">
                            Geen tickets.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped></style>
