<script setup lang="ts">
import type { Category } from '@/types';

const title = defineModel<string>('title', { required: true });
const description = defineModel<string>('description', { required: true });
const categoryIds = defineModel<number[]>('categoryIds', { required: true });

defineProps<{
    categories: Category[];
    errors: Record<string, string[]>;
}>();
</script>

<template>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-1">
            <label for="title" class="text-sm font-medium text-content-muted">Titel</label>
            <input
                id="title"
                v-model="title"
                type="text"
                maxlength="255"
                required
                class="rounded border border-border px-3 py-2 text-content"
            />
            <span v-if="errors.title" class="text-sm text-red-600">{{ errors.title[0] }}</span>
        </div>

        <div class="flex flex-col gap-1">
            <label for="description" class="text-sm font-medium text-content-muted"
                >Omschrijving</label
            >
            <textarea
                id="description"
                v-model="description"
                rows="5"
                required
                class="resize-y rounded border border-border px-3 py-2 text-content"
            />
            <span v-if="errors.description" class="text-sm text-red-600">{{
                errors.description[0]
            }}</span>
        </div>

        <fieldset v-if="categories.length" class="flex flex-col gap-2">
            <legend class="text-sm font-medium text-content-muted">Categorieën</legend>
            <label
                v-for="cat in categories"
                :key="cat.id"
                class="flex items-center gap-2 text-sm text-content"
            >
                <input v-model="categoryIds" type="checkbox" :value="cat.id" />
                {{ cat.name }}
            </label>
            <span v-if="errors.categories" class="text-sm text-red-600">{{
                errors.categories[0]
            }}</span>
        </fieldset>
    </div>
</template>

<style scoped></style>
