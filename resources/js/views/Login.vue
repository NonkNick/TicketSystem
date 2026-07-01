<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api, { csrf } from '../lib/axios'

const router = useRouter()

const email = ref('')
const password = ref('')
const remember = ref(false)

const errors = ref({})
const submitting = ref(false)

async function submit() {
  submitting.value = true
  errors.value = {}

  try {
    await csrf()                    // 1. get the XSRF-TOKEN cookie first
    await api.post('/login', {      // 2. hits /api/login
      email: email.value,
      password: password.value,
      remember: remember.value,
    })
    router.push({ name: 'home' })   // 3. redirect to the ticket overview
  } catch (e) {
    if (e.response?.status === 422) {
      errors.value = e.response.data.errors ?? {}
    } else {
      errors.value = { email: ['Er ging iets mis. Probeer het later opnieuw.'] }
    }
  } finally {
    submitting.value = false
  }
}
</script>

<template>
  <main class="flex min-h-dvh items-center justify-center p-4">
    <form class="flex w-full max-w-sm flex-col gap-4" @submit.prevent="submit">
      <h1 class="text-xl font-semibold">Login</h1>

      <div class="flex flex-col gap-1">
        <label for="email" class="text-sm font-medium">Email</label>
        <input
            id="email"
            v-model="email"
            type="email"
            autocomplete="email"
            required
            class="rounded border border-gray-300 px-3 py-2"
        />
        <span v-if="errors.email" class="text-sm text-red-600">{{ errors.email[0] }}</span>
      </div>

      <div class="flex flex-col gap-1">
        <label for="password" class="text-sm font-medium">Password</label>
        <input
            id="password"
            v-model="password"
            type="password"
            autocomplete="current-password"
            required
            class="rounded border border-gray-300 px-3 py-2"
        />
        <span v-if="errors.password" class="text-sm text-red-600">{{ errors.password[0] }}</span>
      </div>

      <label class="flex items-center gap-2 text-sm">
        <input v-model="remember" type="checkbox" />
        Onthoud mij
      </label>

      <button
          type="submit"
          :disabled="submitting"
          class="rounded bg-gray-900 px-3 py-2 text-white disabled:opacity-50"
      >
        {{ submitting ? 'Bezig…' : 'Login' }}
      </button>
    </form>
  </main>
</template>