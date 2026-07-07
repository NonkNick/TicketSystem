<script setup lang="ts">
import { computed } from 'vue';
import { Check } from 'lucide-vue-next';

const props = withDefaults(
    defineProps<{
        value?: string;
        submitting?: boolean;
        disabled?: boolean;
    }>(),
    { value: undefined, submitting: false, disabled: false },
);

const emit = defineEmits<{ submit: [value: string] }>();

const canSubmit = computed(
    () =>
        !props.submitting &&
        !props.disabled &&
        (props.value === undefined || props.value.trim().length > 0),
);

function submit() {
    if (!canSubmit.value) return;
    emit('submit', props.value?.trim() ?? '');
}
</script>

<template>
    <button
        type="button"
        aria-label="Versturen"
        :disabled="!canSubmit"
        class="
            rounded bg-primary p-2 text-primary-foreground
            hover:bg-primary-hover
            disabled:opacity-50
        "
        @click="submit"
    >
        <Check class="h-4 w-4" />
    </button>
</template>

<style scoped></style>
