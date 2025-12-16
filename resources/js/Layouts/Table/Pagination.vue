<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
    meta: {
        type: Object,
        default: () => ({
            total: 0,
            per_page: 0,
        }),
    },
});
</script>

<template>
    <div v-if="meta.total > meta.per_page" class="flex gap-1 mt-4">
        <Link
            v-for="(link, i) in links"
            :key="i"
            :href="link.url"
            v-html="link.label"
            class="px-3 py-1 border rounded"
            :class="{
                'bg-blue-600 text-white': link.active,
                'text-gray-400 pointer-events-none': !link.url,
            }"
        />
    </div>
</template>
