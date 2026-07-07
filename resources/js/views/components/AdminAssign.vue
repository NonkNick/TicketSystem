<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { UserPlus } from 'lucide-vue-next';
import api from '../../lib/axios';
import type { User } from '@/types';
import { useAuthStore } from '@/stores/auth';

const props = defineProps<{ ticketId: number }>();
const emit = defineEmits<{ assigned: [User] }>();

const auth = useAuthStore();
const admins = ref<User[]>([]);
const selected = ref('');
const isAssigned = ref(false);

onMounted(async () => {
    const { data: adminList } = await api.get<{ data: User[] }>('/users/admin');
    admins.value = adminList.data;
});

async function assign(userId: number) {
    const { data: ticket } = await api.patch<{ data: { assignee: User } }>(
        `/tickets/${props.ticketId}`,
        { assigned_to: userId },
    );
    isAssigned.value = true;
    emit('assigned', ticket.data.assignee);
}

function assignSelf() {
    if (auth.user) assign(auth.user.id);
}

function assignSelected() {
    if (selected.value) assign(Number(selected.value));
}
</script>

<template>
    <div class="flex items-center">
        <button
            type="button"
            class="rounded-full hover:bg-accent"
            :class="{ 'text-accent': isAssigned }"
            @click="assignSelf"
        >
            <UserPlus class="h-4 w-4" />
        </button>
        <select
            v-model="selected"
            class="w-5 cursor-pointer bg-transparent hover:text-accent"
            @change="assignSelected"
        >
            <option value="" hidden></option>
            <option v-for="user in admins" :key="user.id" :value="user.id">
                {{ user.name }}
            </option>
        </select>
    </div>
</template>

<style scoped></style>
