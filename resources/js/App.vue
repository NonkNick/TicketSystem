<script setup>
import { RouterLink, RouterView } from 'vue-router';
import Sidebar from "./views/components/Sidebar.vue";
</script>

<template>

    <main class="h-dvh">
      <div class="flex h-full flex-row">
        <Sidebar class="border shrink-0" />

        <div class="flex-1 overflow-auto">
          <RouterView />
        </div>

      </div>
    </main>
  </template>