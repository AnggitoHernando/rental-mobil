<script setup>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import WhyUs from "@/Components/Home/WhyUs.vue";
import HomeSlider from "@/Components/Home/HomeSlider.vue";
import CarGrid from "@/Components/Home/CarGrid.vue";
defineProps({ cars: Array });
</script>

<template>
    <div>
        <HomeLayout>
            <HomeSlider />
            <WhyUs />
            <CarGrid :cars="cars" />
        </HomeLayout>
    </div>
</template>
