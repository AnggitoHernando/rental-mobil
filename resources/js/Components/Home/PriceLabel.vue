<script setup>
defineProps({
    label: String,
    value: String,
});
</script>

<template>
    <div class="rounded-2xl bg-gray-50 py-3 text-center">
        <p class="text-[11px] text-gray-400">{{ label }}</p>
        <p class="font-semibold">{{ value }}</p>
    </div>
</template>
