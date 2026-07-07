<script setup lang="ts">
import { ref } from 'vue';
import { isAxiosError } from 'axios';
import api, { csrf } from '../lib/axios';

const email = ref('');
const errors = ref<Record<string, string[]>>({});
const submitting = ref(false);
const sent = ref(false);

async function submit() {
    submitting.value = true;
    errors.value = {};

    try {
        await csrf();
        await api.post('/forgot-password', { email: email.value });
        // Neutral confirmation: don't reveal whether the address exists.
        sent.value = true;
    } catch (e) {
        if (isAxiosError(e) && e.response?.status === 422) {
            errors.value = e.response.data.errors ?? {};
        } else {
            errors.value = { email: ['Er ging iets mis. Probeer het later opnieuw.'] };
        }
    } finally {
        submitting.value = false;
    }
}
</script>

<template>
    <main class="flex min-h-dvh items-center justify-center p-4">
        <form class="flex w-full max-w-sm flex-col gap-4" @submit.prevent="submit">
            <h1 class="text-xl font-semibold text-content">Wachtwoord vergeten</h1>

            <p v-if="sent" class="text-sm text-content-muted">
                Als dit e-mailadres bekend is, is er een resetlink verstuurd.
            </p>

            <template v-else>
                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-content-muted">Email</label>
                    <input
                        id="email"
                        v-model="email"
                        type="email"
                        autocomplete="email"
                        required
                        class="rounded border border-border px-3 py-2 text-content"
                    />
                    <span v-if="errors.email" class="text-sm text-red-600">{{ errors.email[0] }}</span>
                </div>

                <button
                    type="submit"
                    :disabled="submitting"
                    class="
                        rounded bg-primary px-3 py-2 text-white
                        hover:bg-primary-hover
                        disabled:opacity-50
                    "
                >
                    {{ submitting ? 'Bezig…' : 'Verstuur resetlink' }}
                </button>
            </template>

            <p class="text-sm text-content-muted">
                <router-link :to="{ name: 'login' }" class="text-primary hover:underline">
                    Terug naar login
                </router-link>
            </p>
        </form>
    </main>
</template>
