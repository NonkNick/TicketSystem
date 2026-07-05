<script setup lang="ts">
import Sidebar from '../views/components/Sidebar.vue';
</script>

<template>
    <main class="h-full">
        <div class="flex h-full flex-row">
            <Sidebar class="w-1/3" />
            <div class="flex-1">
                <RouterView />
            </div>
        </div>
    </main>
</template>
