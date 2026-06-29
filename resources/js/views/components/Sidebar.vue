<script setup>

import {RouterLink} from "vue-router";

import {ref} from "vue";
import TicketListItem from "./TicketListItem.vue";

const tickets = ref([
  {
    id: 1,
    user_id: 3,
    assigned_to: null,
    title: 'Kan niet inloggen op de werkomgeving',
    description: 'Sinds vanochtend krijg ik bij het inloggen de melding "ongeldige inloggegevens", terwijl mijn wachtwoord wel klopt.',
    status: 'in_afwachting',
    created_at: '2026-06-22 08:14:03',
    updated_at: '2026-06-22 08:14:03',
  },
  {
    id: 2,
    user_id: 5,
    assigned_to: 2,
    title: 'Printer op de tweede verdieping doet het niet',
    description: 'De netwerkprinter (HP-2F) reageert niet meer en staat offline in de wachtrij.',
    status: 'in_behandeling',
    created_at: '2026-06-21 13:42:51',
    updated_at: '2026-06-22 09:05:10',
  },
  {
    id: 3,
    user_id: 3,
    assigned_to: 2,
    title: 'VPN verbreekt elke paar minuten',
    description: 'Tijdens het thuiswerken valt de VPN-verbinding steeds weg waardoor ik telkens opnieuw moet verbinden.',
    status: 'afgehandeld',
    created_at: '2026-06-18 10:00:00',
    updated_at: '2026-06-20 16:30:22',
  },
  {
    id: 4,
    user_id: 7,
    assigned_to: null,
    title: 'Nieuwe medewerker heeft toegang nodig tot CRM',
    description: 'Graag een account aanmaken voor onze nieuwe collega zodat zij bij het CRM-systeem kan.',
    status: 'in_afwachting',
    created_at: '2026-06-23 07:55:40',
    updated_at: '2026-06-23 07:55:40',
  },
  {
    id: 5,
    user_id: 5,
    assigned_to: 4,
    title: 'Outlook synchroniseert agenda niet',
    description: 'Afspraken die op mijn telefoon staan verschijnen niet in de Outlook-agenda op mijn laptop.',
    status: 'in_behandeling',
    created_at: '2026-06-20 11:20:09',
    updated_at: '2026-06-22 14:48:33',
  },
])

</script>

<template>
  <div class="flex flex-col gap-4 p-4">
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/about">About</RouterLink>
    <TicketListItem v-for="ticket in tickets" :key="ticket.id" :ticket="ticket" />

  </div>

</template>

<style scoped>

</style>