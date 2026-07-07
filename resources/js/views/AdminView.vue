<script setup lang="ts">
import CategoryList from '@/views/components/CategoryList.vue';
import UserManagementList from '@/views/components/UserManagementList.vue';
</script>

<template>
    <div class="flex flex-col gap-4 p-4">
        <UserManagementList />
        <CategoryList />
    </div>
</template>

<style scoped></style>
