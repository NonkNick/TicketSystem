<script setup lang="ts">
import { computed, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { isAxiosError } from 'axios';
import api, { csrf } from '../lib/axios';

const route = useRoute();
const router = useRouter();

const token = route.params.token as string;
const email = (route.query.email as string) ?? '';
const validLink = computed(() => Boolean(token && email));

const password = ref('');
const passwordConfirmation = ref('');
const errors = ref<Record<string, string[]>>({});
const submitting = ref(false);

async function submit() {
    submitting.value = true;
    errors.value = {};

    try {
        await csrf();
        await api.post('/reset-password', {
            token,
            email,
            password: password.value,
            password_confirmation: passwordConfirmation.value,
        });
        router.push({ name: 'login' });
    } catch (e) {
        if (isAxiosError(e) && e.response?.status === 422) {
            errors.value = e.response.data.errors ?? {};
        } else {
            errors.value = { password: ['Er ging iets mis. Probeer het later opnieuw.'] };
        }
    } finally {
        submitting.value = false;
    }
}
</script>

<template>
    <main class="flex min-h-dvh items-center justify-center p-4">
        <form class="flex w-full max-w-sm flex-col gap-4" @submit.prevent="submit">
            <h1 class="text-xl font-semibold text-content">Nieuw wachtwoord</h1>

            <p v-if="!validLink" class="text-sm text-red-600">
                Ongeldige of onvolledige resetlink.
            </p>

            <template v-else>
                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-medium text-content-muted">
                        Nieuw wachtwoord
                    </label>
                    <input
                        id="password"
                        v-model="password"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="rounded border border-border px-3 py-2 text-content"
                    />
                    <span v-if="errors.password" class="text-sm text-red-600">
                        {{ errors.password[0] }}
                    </span>
                    <span v-if="errors.email" class="text-sm text-red-600">{{ errors.email[0] }}</span>
                </div>

                <div class="flex flex-col gap-1">
                    <label
                        for="password_confirmation"
                        class="text-sm font-medium text-content-muted"
                    >
                        Bevestig wachtwoord
                    </label>
                    <input
                        id="password_confirmation"
                        v-model="passwordConfirmation"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="rounded border border-border px-3 py-2 text-content"
                    />
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
                    {{ submitting ? 'Bezig…' : 'Wachtwoord opslaan' }}
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
