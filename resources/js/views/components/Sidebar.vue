<script setup>

import {RouterLink} from "vue-router";

import {onMounted, ref} from "vue";
import api from "../../lib/axios";
import TicketListItem from "./TicketListItem.vue";

const tickets = ref([])

onMounted(async () => {
  const { data } = await api.get('/tickets')
  tickets.value = data
  console.log(data)
})

</script>

<template>
  <div class="flex flex-col gap-4 p-4">
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/about">About</RouterLink>
    <RouterLink to="/login">Login</RouterLink>
    <TicketListItem v-for="ticket in tickets" :key="ticket.id" :ticket="ticket" />

  </div>

</template>

<style scoped>

</style>
