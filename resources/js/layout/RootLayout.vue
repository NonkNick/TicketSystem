<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { RouterView } from 'vue-router';
import { useThemeStore } from '../stores/theme';

const themeStore = useThemeStore();
const { theme } = storeToRefs(themeStore);
</script>

<template>
    <div class="flex h-dvh flex-col overflow-hidden bg-background text-content-muted">
        <header class="flex items-center justify-between border-b border-border px-4 py-2">
            <span class="font-semibold text-content">TicketSystem</span>
            <button
                type="button"
                class="rounded border border-border px-3 py-1 text-sm hover:bg-surface"
                @click="themeStore.toggle()"
            >
                {{ theme === 'dark' ? '☀ Light' : '☾ Dark' }}
            </button>
        </header>

        <div class="min-h-0 flex-1">
            <RouterView />
        </div>
    </div>
</template>
