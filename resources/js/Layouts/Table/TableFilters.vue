<script setup>
import { Combobox, ComboboxInput } from "@headlessui/vue";
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    filters: Object,
    routeName: String,
});

const search = ref(props.filters.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route(props.routeName),
            {
                ...props.filters,
                search: value,
                page: 1,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 400)
);
</script>

<template>
    <div class="mb-4 max-w-sm">
        <Combobox v-model="search">
            <div class="relative">
                <ComboboxInput
                    class="w-full rounded border px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Search..."
                />
            </div>
        </Combobox>
    </div>
</template>
