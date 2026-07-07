<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { isAxiosError } from 'axios';
import api, { csrf } from '@/lib/axios';
import type { Category, Ticket } from '@/types';
import TicketFormFields from '@/views/components/TicketFormFields.vue';

const router = useRouter();

const title = ref('');
const description = ref('');
const categories = ref<Category[]>([]);
const selectedCategoryIds = ref<number[]>([]);

const errors = ref<Record<string, string[]>>({});
const submitting = ref(false);

onMounted(async () => {
    const { data } = await api.get<{ data: Category[] }>('/categories');
    categories.value = data.data;
});

async function submit() {
    submitting.value = true;
    errors.value = {};

    try {
        await csrf();
        const { data } = await api.post<{ data: Ticket }>('/tickets', {
            title: title.value,
            description: description.value,
            categories: selectedCategoryIds.value,
        });
        router.push({ name: 'tickets', params: { id: data.data.id } });
    } catch (e) {
        if (isAxiosError(e) && e.response?.status === 422) {
            errors.value = e.response.data.errors ?? {};
        } else {
            errors.value = { title: ['Er ging iets mis. Probeer het later opnieuw.'] };
        }
    } finally {
        submitting.value = false;
    }
}
</script>

<template>
    <main class="flex min-h-dvh items-start justify-center p-4">
        <form class="flex w-full max-w-lg flex-col gap-4 py-8" @submit.prevent="submit">
            <h1 class="text-xl font-semibold text-content">Nieuw ticket</h1>

            <TicketFormFields
                v-model:title="title"
                v-model:description="description"
                v-model:category-ids="selectedCategoryIds"
                :categories="categories"
                :errors="errors"
            />

            <div class="flex items-center gap-2">
                <button
                    type="submit"
                    :disabled="submitting"
                    class="
                        rounded bg-primary px-3 py-2 text-white
                        hover:bg-primary-hover
                        disabled:opacity-50
                    "
                >
                    {{ submitting ? 'Bezig…' : 'Ticket aanmaken' }}
                </button>
                <button
                    type="button"
                    class="
                        rounded border border-border px-3 py-2 text-content
                        hover:bg-surface-hover
                    "
                    @click="router.back()"
                >
                    Annuleren
                </button>
            </div>
        </form>
    </main>
</template>

<style scoped></style>
