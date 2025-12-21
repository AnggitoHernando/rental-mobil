<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Menu, X, Car, Phone } from "lucide-vue-next";

const isOpen = ref(false);
const page = usePage();

const navs = [
    { name: "Home", href: "/" },
    { name: "Armada", href: "/armada" },
    { name: "Harga", href: "/harga" },
    { name: "Tentang", href: "/tentang" },
    { name: "Kontak", href: "/kontak" },
];

const isActive = (href) => page.url === href;
</script>

<template>
    <header class="sticky top-0 z-50">
        <nav class="bg-white/80 backdrop-blur border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex h-16 items-center justify-between">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center gap-2">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white"
                        >
                            <Car class="w-5 h-5" />
                        </div>
                        <span class="font-semibold text-lg tracking-tight">
                            RentCar
                        </span>
                    </Link>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-10">
                        <Link
                            v-for="nav in navs"
                            :key="nav.href"
                            :href="nav.href"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition"
                        >
                            {{ nav.name }}
                        </Link>
                    </div>

                    <!-- CTA Desktop -->
                    <div class="hidden md:flex items-center gap-3">
                        <a
                            href="https://wa.me/628123456789"
                            target="_blank"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50"
                        >
                            <Phone class="w-4 h-4" />
                            WhatsApp
                        </a>

                        <Link
                            href="/booking"
                            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
                        >
                            Booking Sekarang
                        </Link>
                    </div>

                    <!-- Mobile Button -->
                    <button
                        @click="isOpen = !isOpen"
                        class="md:hidden rounded-lg p-2 hover:bg-gray-100"
                    >
                        <Menu v-if="!isOpen" class="w-6 h-6" />
                        <X v-else class="w-6 h-6" />
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div
                v-if="isOpen"
                class="md:hidden border-t border-gray-100 bg-white"
            >
                <div class="space-y-1 px-4 py-4">
                    <Link
                        v-for="nav in navs"
                        :key="nav.href"
                        :href="nav.href"
                        class="block rounded-lg px-3 py-2 text-sm font-medium"
                        :class="
                            isActive(nav.href)
                                ? 'bg-blue-50 text-blue-600'
                                : 'text-gray-700 hover:bg-gray-100'
                        "
                        @click="isOpen = false"
                    >
                        {{ nav.name }}
                    </Link>

                    <div class="pt-3 space-y-2">
                        <Link
                            href="/booking"
                            class="block text-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white"
                        >
                            Booking Sekarang
                        </Link>

                        <a
                            href="https://wa.me/628123456789"
                            target="_blank"
                            class="block text-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium"
                        >
                            Hubungi WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
