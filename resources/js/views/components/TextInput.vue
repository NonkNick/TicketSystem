<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        modelValue?: string;
        placeholder?: string;
        submitting?: boolean;
        disabled?: boolean;
        rows?: number;
    }>(),
    { modelValue: '', placeholder: '', submitting: false, disabled: false, rows: 3 },
);

const emit = defineEmits<{
    'update:modelValue': [value: string];
    submit: [value: string];
}>();

const canSubmit = computed(
    () => !props.disabled && !props.submitting && props.modelValue.trim().length > 0,
);

function onInput(event: Event) {
    emit('update:modelValue', (event.target as HTMLTextAreaElement).value);
}

function submit() {
    if (!canSubmit.value) return;
    emit('submit', props.modelValue.trim());
}
</script>

<template>
    <textarea
        :value="modelValue"
        :placeholder="placeholder"
        :disabled="disabled || submitting"
        :rows="rows"
        class="
            w-full resize-y rounded border border-border px-3 py-2 text-content
            placeholder:text-content-subtle
            focus:border-accent focus:outline-none
            disabled:opacity-50
        "
        @input="onInput"
        @keydown.enter.meta.prevent="submit"
        @keydown.enter.ctrl.prevent="submit"
    />
</template>

<style scoped></style>
