<script setup>
import { ref, onMounted } from "vue";

const slides = [
    {
        title: "Sewa Mobil Mudah & Cepat",
        image: "https://images.unsplash.com/photo-1503376780353-7e6692767b70",
    },
    {
        title: "Armada Lengkap & Terawat",
        image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7",
    },
    {
        title: "Harga Fleksibel & Transparan",
        image: "https://images.unsplash.com/photo-1502877338535-766e1452684a",
    },
];

const index = ref(0);
let startX = 0;

const next = () => (index.value = (index.value + 1) % slides.length);
const prev = () =>
    (index.value = (index.value - 1 + slides.length) % slides.length);

onMounted(() => {
    setInterval(next, 6000);
});
</script>

<template>
    <section class="relative overflow-hidden">
        <div
            class="flex transition-transform duration-500 cursor-grab"
            :style="{ transform: `translateX(-${index * 100}%)` }"
            @touchstart="(e) => (startX = e.touches[0].clientX)"
            @touchend="
                (e) => {
                    const diff = e.changedTouches[0].clientX - startX;
                    if (diff > 50) prev();
                    if (diff < -50) next();
                }
            "
        >
            <div
                v-for="(slide, i) in slides"
                :key="i"
                class="min-w-full h-[420px] bg-cover bg-center flex items-center justify-center text-white"
                :style="{ backgroundImage: `url(${slide.image})` }"
            >
                <h2 class="text-4xl font-bold bg-black/40 px-6 py-3 rounded-xl">
                    {{ slide.title }}
                </h2>
            </div>
        </div>

        <button
            @click="prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2"
        >
            ❮
        </button>
        <button
            @click="next"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2"
        >
            ❯
        </button>
    </section>
</template>
