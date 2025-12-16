<script setup>
import { Link } from "@inertiajs/vue3";
import {
    LayoutDashboard,
    Car,
    Calendar,
    ChevronLeft,
    ChevronRight,
} from "lucide-vue-next";
defineProps({
    collapsed: Boolean,
    mobile: Boolean,
    open: Boolean,
});

defineEmits(["close"]);
</script>

<template>
    <aside
        class="bg-white border-r border-gray-200 h-screen transition-all duration-200 flex flex-col"
        :class="[
            mobile
                ? open
                    ? 'w-64 translate-x-0'
                    : '-translate-x-full w-64'
                : collapsed
                ? 'w-20'
                : 'w-64',
        ]"
    >
        <div class="h-16 flex items-center justify-between px-4 border-b">
            <span class="font-bold text-lg truncate">
                <span v-if="!collapsed">Admin Panel</span>
                <span v-else>A</span>
            </span>
            <button
                v-if="mobile"
                class="p-3 text-right md:hidden"
                @click="$emit('close')"
            >
                ✕
            </button>
        </div>

        <nav class="p-4 space-y-2">
            <Link
                :href="route('dashboard')"
                class="flex items-center gap-3 p-2 rounded hover:bg-gray-100"
            >
                <LayoutDashboard class="w-5 h-5" />
                <span v-if="!collapsed">Dashboard</span>
            </Link>

            <Link
                :href="route('mobil.index')"
                class="flex items-center gap-3 p-2 rounded hover:bg-gray-100"
            >
                <Car class="w-5 h-5" />
                <span v-if="!collapsed">Mobil</span>
            </Link>

            <Link class="flex items-center gap-3 p-2 rounded hover:bg-gray-100">
                <Calendar class="w-5 h-5" />
                <span v-if="!collapsed">Booking</span>
            </Link>
        </nav>
    </aside>
</template>
