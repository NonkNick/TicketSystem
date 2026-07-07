<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { isAxiosError } from 'axios';
import api, { csrf } from '../lib/axios';

const router = useRouter();

const firstName = ref('');
const lastName = ref('');
const email = ref('');
const phone = ref('');
const password = ref('');
const passwordConfirmation = ref('');

const errors = ref<Record<string, string[]>>({});
const submitting = ref(false);

async function submit() {
    submitting.value = true;
    errors.value = {};

    try {
        await csrf();
        await api.post('/register', {
            first_name: firstName.value,
            last_name: lastName.value,
            email: email.value,
            phone: phone.value || null,
            password: password.value,
            password_confirmation: passwordConfirmation.value,
        });
        router.push({ name: 'home' });
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
            <h1 class="text-xl font-semibold text-content">Registreren</h1>

            <div class="flex flex-col gap-1">
                <label for="first_name" class="text-sm font-medium text-content-muted"
                    >Voornaam</label
                >
                <input
                    id="first_name"
                    v-model="firstName"
                    type="text"
                    autocomplete="given-name"
                    required
                    class="rounded border border-border px-3 py-2 text-content"
                />
                <span v-if="errors.first_name" class="text-sm text-red-600">{{
                    errors.first_name[0]
                }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <label for="last_name" class="text-sm font-medium text-content-muted"
                    >Achternaam</label
                >
                <input
                    id="last_name"
                    v-model="lastName"
                    type="text"
                    autocomplete="family-name"
                    required
                    class="rounded border border-border px-3 py-2 text-content"
                />
                <span v-if="errors.last_name" class="text-sm text-red-600">{{
                    errors.last_name[0]
                }}</span>
            </div>

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

            <div class="flex flex-col gap-1">
                <label for="phone" class="text-sm font-medium text-content-muted"
                    >Telefoon (optioneel)</label
                >
                <input
                    id="phone"
                    v-model="phone"
                    type="tel"
                    autocomplete="tel"
                    class="rounded border border-border px-3 py-2 text-content"
                />
                <span v-if="errors.phone" class="text-sm text-red-600">{{ errors.phone[0] }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <label for="password" class="text-sm font-medium text-content-muted"
                    >Wachtwoord</label
                >
                <input
                    id="password"
                    v-model="password"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="rounded border border-border px-3 py-2 text-content"
                />
                <span v-if="errors.password" class="text-sm text-red-600">{{
                    errors.password[0]
                }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <label for="password_confirmation" class="text-sm font-medium text-content-muted"
                    >Bevestig wachtwoord</label
                >
                <input
                    id="password_confirmation"
                    v-model="passwordConfirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="rounded border border-border px-3 py-2 text-content"
                />
                <span v-if="errors.password_confirmation" class="text-sm text-red-600">{{
                    errors.password_confirmation[0]
                }}</span>
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
                {{ submitting ? 'Bezig…' : 'Registreren' }}
            </button>

            <p class="text-sm text-content-muted">
                Heb je al een account?
                <router-link :to="{ name: 'login' }" class="text-primary hover:underline"
                    >Login</router-link
                >
            </p>
        </form>
    </main>
</template>
