<script setup>
import CarCard from "./CarCard.vue";
defineProps({ cars: Array });
</script>

<template>
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h3 class="text-2xl font-semibold mb-6">Pilihan Mobil</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <CarCard v-for="car in cars" :key="car.name" :car="car" />
        </div>
    </section>
</template>
