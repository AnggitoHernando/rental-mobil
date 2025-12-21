<script setup>
import { useCurrencyInput } from "vue-currency-input";
import { watch } from "vue";

const props = defineProps({
    modelValue: {
        type: Number,
        default: null,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    options: {
        type: Object,
        default: () => ({
            currency: "IDR",
            locale: "id-ID",
            precision: 0,
            distractionFree: false,
        }),
    },
});

const emit = defineEmits(["update:modelValue", "change"]);

const { inputRef, setValue } = useCurrencyInput(props.options, { emit, props });

watch(
    () => props.modelValue,
    (val) => {
        if (inputRef.value) setValue(val || 0);
    },
    { immediate: true }
);
</script>
<template>
    <div class="space-y-1">
        <input
            ref="inputRef"
            :disabled="props.disabled"
            :class="['input-new border-gray-300 focus:ring-indigo-200']"
        />
    </div>
</template>
