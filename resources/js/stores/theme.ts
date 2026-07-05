import { defineStore } from 'pinia';
import { ref, watch } from 'vue';

type Theme = 'light' | 'dark';

const STORAGE_KEY = 'theme';

export const useThemeStore = defineStore('theme', () => {
    // Eerder opgeslagen keuze, anders het OS-thema.
    const stored = localStorage.getItem(STORAGE_KEY);
    const theme = ref<Theme>(
        stored === 'dark' || stored === 'light'
            ? stored
            : window.matchMedia('(prefers-color-scheme: dark)').matches
              ? 'dark'
              : 'light',
    );

    watch(
        theme,
        (value) => {
            const el = document.documentElement;
            el.classList.toggle('dark', value === 'dark');
            el.classList.toggle('light', value === 'light');
            localStorage.setItem(STORAGE_KEY, value);
        },
        { immediate: true },
    );

    function toggle() {
        theme.value = theme.value === 'dark' ? 'light' : 'dark';
    }

    return { theme, toggle };
});
