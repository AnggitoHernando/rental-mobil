<script setup>
import Navbar from "@/Components/Home/Navbar.vue";
import Footer from "@/Components/Home/Footer.vue";
</script>

<template>
    <div>
        <Navbar />
        <main>
            <slot />
        </main>
        <Footer />
    </div>
</template>
