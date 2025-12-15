<script setup>
import { ref } from "vue";
import Sidebar from "@/Components/Admin/Sidebar.vue";
import Navbar from "@/Components/Admin/Navbar.vue";

const sidebarCollapsed = ref(false); // desktop
const mobileSidebarOpen = ref(false); // mobile
</script>

<template>
    <div class="min-h-screen flex bg-gray-100">
        <!-- DESKTOP SIDEBAR -->
        <Sidebar
            class="hidden md:flex"
            :collapsed="sidebarCollapsed"
            @toggleCollapse="sidebarCollapsed = !sidebarCollapsed"
        />

        <!-- MOBILE SIDEBAR (DRAWER) -->
        <Sidebar
            class="md:hidden fixed inset-y-0 left-0 z-40"
            :collapsed="false"
            :mobile="true"
            :open="mobileSidebarOpen"
            @close="mobileSidebarOpen = false"
        />

        <!-- BACKDROP MOBILE -->
        <div
            v-if="mobileSidebarOpen"
            class="fixed inset-0 bg-black/40 z-30 md:hidden"
            @click="mobileSidebarOpen = false"
        />

        <!-- CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- NAVBAR -->
            <Navbar
                @toggleCollapse="sidebarCollapsed = !sidebarCollapsed"
                @toggleMobile="mobileSidebarOpen = !mobileSidebarOpen"
            />

            <main class="flex-1">
                <div class="p-6 max-w-7xl w-full mx-auto">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
