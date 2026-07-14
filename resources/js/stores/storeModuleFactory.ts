import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import api from '@/lib/axios';

export function storeModuleFactory<T extends { id: number }>(moduleName: string) {
    return defineStore(moduleName, () => {
        const items = ref<Record<number, T>>({});

        const all = computed<T[]>(() => Object.values(items.value));
        const byId = (id: number): T | undefined => items.value[id];
        function setAll(list: T[]): void {
            for (const item of list) {
                items.value[item.id] = Object.freeze(item) as T;
            }
        }
        async function getAll(): Promise<void> {
            const { data } = await api.get<{ data: T[] }>(`/${moduleName}`);
            if (!data?.data) return;
            setAll(data.data);
        }

        return { all, byId, getAll };
    });
}
