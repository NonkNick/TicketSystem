<script setup lang="ts">
import Sidebar from '../views/components/Sidebar.vue';
</script>

<template>
    <main class="h-full">
        <div class="flex h-full flex-row">
            <Sidebar class="w-2/5" />
            <div class="min-w-0 flex-1 overflow-y-auto">
                <RouterView />
            </div>
        </div>
    </main>
</template>
