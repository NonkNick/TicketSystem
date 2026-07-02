<script setup>
import Sidebar from "../views/components/Sidebar.vue";
</script>

<template>
  <main class="h-dvh">
    <div class="flex h-full flex-row">
      <Sidebar class="border overflow-auto w-1/3" />
      <div class="flex-1 ">
        <RouterView />
      </div>
    </div>
  </main>
</template>