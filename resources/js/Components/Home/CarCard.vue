<script setup>
import PriceLabel from "./PriceLabel.vue";
defineProps({ car: Object });
</script>

<template>
    <div
        class="group cursor-pointer relative bg-white rounded-3xl border border-gray-100 hover:border-blue-300 transition overflow-hidden"
    >
        <div class="relative">
            <img
                :src="car.image"
                class="h-56 w-full object-cover group-hover:scale-110 transition duration-500"
            />
            <div class="absolute top-3 left-3 flex gap-2">
                <span class="badge">{{ car.year }}</span>
                <span class="badge">{{ car.color }}</span>
            </div>
        </div>

        <div class="p-5 space-y-5">
            <div class="flex justify-between">
                <div>
                    <h4 class="text-lg font-semibold">{{ car.name }}</h4>
                    <p class="text-sm text-gray-500">
                        {{ car.capacity }} Penumpang • {{ car.transmission }}
                    </p>
                </div>
                <span
                    class="inline-flex items-center text-[11px] font-medium px-2.5 py-0.5 rounded-full"
                    :class="
                        car.available
                            ? 'bg-green-50 text-green-600'
                            : 'bg-red-50 text-red-600'
                    "
                >
                    {{ car.available ? "Available" : "Booked" }}
                </span>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <PriceLabel label="Harian" :value="car.prices.daily" />
                <PriceLabel label="Mingguan" :value="car.prices.weekly" />
                <PriceLabel label="Bulanan" :value="car.prices.monthly" />
            </div>

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl text-sm font-semibold"
            >
                Pesan Sekarang
            </button>
        </div>
    </div>
</template>

<style scoped>
.badge {
    @apply bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-medium;
}
</style>
