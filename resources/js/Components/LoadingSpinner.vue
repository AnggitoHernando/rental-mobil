<script setup>
import { Loader } from "lucide-vue-next";
const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});
</script>
<template>
    <div
        v-show="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50"
    >
        <div class="flex flex-col items-center space-y-2">
            <Loader class="w-12 h-12 text-gray-200 animate-spin" />
            <span class="text-white text-lg font-medium">Loading...</span>
        </div>
    </div>
</template>
