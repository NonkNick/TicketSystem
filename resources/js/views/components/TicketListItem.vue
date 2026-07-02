<script setup lang="ts">
type TicketStatus = 'in_afwachting' | 'in_behandeling' | 'afgehandeld'

interface TicketUser {
  id: number
  name: string
}

interface Category {
  id: number
  name: string
}

interface Ticket {
  id: number
  title: string
  description: string
  status: TicketStatus
  created_at: string
  updated_at: string
  creator: TicketUser
  assignee: TicketUser | null
  categories: Category[]
}

const props = defineProps<{
  ticket: Ticket
}>()

const statusLabels: Record<TicketStatus, string> = {
  in_afwachting: 'In afwachting',
  in_behandeling: 'In behandeling',
  afgehandeld: 'Afgehandeld',
}

const statusLabel = statusLabels[props.ticket.status]
</script>

<template>
  <div class="flex flex-col gap-2 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
    <div class="flex items-center justify-between">
      <span class="text-sm font-medium text-gray-500">#{{ ticket.id }}</span>
      <span class="rounded-full px-2 py-0.5 text-xs font-semibold"
            :class="{
          'bg-yellow-100 text-yellow-800': ticket.status === 'in_afwachting',
          'bg-blue-100 text-blue-800':   ticket.status === 'in_behandeling',
          'bg-green-100 text-green-800': ticket.status === 'afgehandeld',
        }"
      >
        {{ statusLabel }}
      </span>
    </div>

    <p class="font-semibold text-gray-900">{{ ticket.title }}</p>
    <p class="line-clamp-2 text-sm text-gray-600">{{ ticket.description }}</p>

    <div v-if="ticket.categories.length" class="flex flex-wrap gap-1">
      <span v-for="category in ticket.categories" :key="category.id"
            class="rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-600">
        {{ category.name }}
      </span>
    </div>

    <div class="flex items-center justify-between text-xs text-gray-400">
      <span>Aangemaakt door: {{ ticket.creator.name }}</span>
      <span v-if="ticket.assignee">Toegewezen aan: {{ ticket.assignee.name }}</span>
      <span v-else class="italic">Niet toegewezen</span>
    </div>
  </div>
</template>

<style scoped>
</style>
