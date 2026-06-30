<script setup>
import api, { csrf } from '../lib/axios.ts'
import {onMounted} from "vue";

onMounted(async () => {
  const response = await csrf();
  console.log(response);
})

</script>

<template>
  <main>
    <form>
      <h1>Login</h1>

      <div>
        <label for="email">Email</label>
        <input
            id="email"
            name="email"
            type="email"
            autocomplete="email"
            required
        />
      </div>

      <div>
        <label for="password">Password</label>
        <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
        />
      </div>

      <button type="submit">Login</button>
    </form>
  </main>
</template>

<style scoped>

</style>