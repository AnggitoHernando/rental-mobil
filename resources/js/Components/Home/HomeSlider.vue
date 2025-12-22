<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from "vue";
import BookingAvability from "../form/BookingAvability.vue";
/**
 * Dummy data internal (nanti bisa kamu ganti dari props/API).
 */
const slides = [
    {
        title: "Sewa Mobil Mudah & Cepat",
        subtitle: "Unit ready, proses cepat, pembayaran fleksibel.",
        image: "https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=60",
    },
    {
        title: "Armada Lengkap & Terawat",
        subtitle: "City car, MPV, SUV—tinggal pilih sesuai kebutuhan.",
        image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1600&q=60",
    },
    {
        title: "Harga Transparan",
        subtitle: "Tanpa biaya tersembunyi, jelas dari awal.",
        image: "https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=1600&q=60",
    },
];

const autoplay = ref(true);
const intervalMs = 6500;

const index = ref(0);
const sliderRef = ref(null);

let timer = null;

// --- Drag state ---
const isDragging = ref(false);
const startX = ref(0);
const deltaX = ref(0);
const width = ref(0);

const trackStyle = computed(() => {
    // posisi base per slide + offset drag
    const x = -(index.value * width.value) + deltaX.value;
    return {
        transform: `translateX(${x}px)`,
        transition: isDragging.value ? "none" : "transform 450ms ease",
    };
});

function measure() {
    width.value = sliderRef.value?.clientWidth ?? 0;
}

function go(i) {
    if (!slides.length) return;
    const max = slides.length - 1;
    index.value = Math.min(Math.max(i, 0), max);
}

function next() {
    go((index.value + 1) % slides.length);
}

function prev() {
    go((index.value - 1 + slides.length) % slides.length);
}

function startAuto() {
    if (!autoplay.value) return;
    stopAuto();
    timer = setInterval(next, intervalMs);
}

function stopAuto() {
    if (timer) clearInterval(timer);
    timer = null;
}

// Pointer Events (mouse + touch)
function onPointerDown(e) {
    if (!width.value) measure();
    isDragging.value = true;
    startX.value = e.clientX;
    deltaX.value = 0;
    stopAuto();
    // capture agar move/up tetap diterima walau pointer keluar area
    e.currentTarget?.setPointerCapture?.(e.pointerId);
}

function onPointerMove(e) {
    if (!isDragging.value) return;
    deltaX.value = e.clientX - startX.value;
}

function onPointerUp() {
    if (!isDragging.value) return;

    const threshold = Math.min(120, width.value * 0.18); // 18% lebar atau max 120px
    const moved = deltaX.value;

    isDragging.value = false;
    deltaX.value = 0;

    if (moved > threshold) prev();
    else if (moved < -threshold) next();

    startAuto();
}

onMounted(() => {
    measure();
    window.addEventListener("resize", measure);
    startAuto();
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", measure);
    stopAuto();
});
</script>

<template>
    <section class="relative overflow-hidden">
        <!-- Wrapper untuk layout hero -->
        <div class="relative h-[520px] md:h-[560px]">
            <!-- Track (translateX) -->
            <div ref="sliderRef" class="absolute inset-0 overflow-hidden">
                <div
                    class="h-full flex"
                    :style="trackStyle"
                    style="touch-action: pan-y"
                    @pointerdown="onPointerDown"
                    @pointermove="onPointerMove"
                    @pointerup="onPointerUp"
                    @pointercancel="onPointerUp"
                    @pointerleave="onPointerUp"
                >
                    <div
                        v-for="(s, i) in slides"
                        :key="i"
                        class="min-w-full h-full relative bg-cover bg-center"
                        :style="{ backgroundImage: `url('${s.image}')` }"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-black/55 via-black/35 to-black/65"
                        ></div>

                        <div
                            class="relative max-w-7xl mx-auto px-4 h-full flex items-center"
                        >
                            <div
                                class="w-full grid grid-cols-1 lg:grid-cols-2 gap-6 items-center"
                            >
                                <div class="text-white">
                                    <p
                                        class="inline-flex items-center bg-white/10 border border-white/20 px-3 py-1 rounded-full text-xs mb-4"
                                    >
                                        Ready unit • Fast response
                                    </p>

                                    <h2
                                        class="text-3xl md:text-5xl font-bold leading-tight"
                                    >
                                        {{ s.title }}
                                    </h2>

                                    <p class="text-white/85 mt-4 max-w-xl">
                                        {{ s.subtitle }}
                                    </p>

                                    <!-- CTA default (boleh kamu ganti) -->
                                    <div class="mt-6 flex flex-wrap gap-3">
                                        <a
                                            href="/armada"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl text-sm font-semibold"
                                        >
                                            Lihat Armada
                                        </a>
                                        <a
                                            href="https://wa.me/6281234567890?text=Halo%20admin%2C%20saya%20mau%20sewa%20mobil."
                                            target="_blank"
                                            class="bg-white/10 hover:bg-white/15 border border-white/20 text-white px-5 py-3 rounded-2xl text-sm font-semibold"
                                        >
                                            Tanya Admin
                                        </a>
                                    </div>

                                    <!-- Controls -->
                                    <div class="mt-8 flex items-center gap-3">
                                        <button
                                            type="button"
                                            class="bg-white/15 hover:bg-white/25 border border-white/20 rounded-full px-3 py-2 text-sm"
                                            @click.stop="prev"
                                        >
                                            ❮
                                        </button>

                                        <button
                                            type="button"
                                            class="bg-white/15 hover:bg-white/25 border border-white/20 rounded-full px-3 py-2 text-sm"
                                            @click.stop="next"
                                        >
                                            ❯
                                        </button>

                                        <div class="flex gap-2 ml-3">
                                            <button
                                                v-for="(_, di) in slides"
                                                :key="di"
                                                type="button"
                                                class="h-2 w-2 rounded-full"
                                                :class="
                                                    di === index
                                                        ? 'bg-white'
                                                        : 'bg-white/40'
                                                "
                                                @click.stop="go(di)"
                                                aria-label="Go to slide"
                                            />
                                        </div>
                                    </div>

                                    <p class="mt-3 text-xs text-white/70">
                                        Tip: drag/swipe kiri-kanan untuk pindah
                                        slide.
                                    </p>
                                </div>

                                <!-- Right: booking card dummy -->
                                <BookingAvability />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border-y border-gray-100">
            <div
                class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-2 md:grid-cols-4 gap-4"
            >
                <div class="text-center">
                    <p class="text-xl font-bold text-gray-900">2.400+</p>
                    <p class="text-xs text-gray-500 mt-1">Transaksi</p>
                </div>
                <div class="text-center">
                    <p class="text-xl font-bold text-gray-900">45+</p>
                    <p class="text-xs text-gray-500 mt-1">Unit aktif</p>
                </div>
                <div class="text-center">
                    <p class="text-xl font-bold text-gray-900">4.8/5</p>
                    <p class="text-xs text-gray-500 mt-1">Rating</p>
                </div>
                <div class="text-center">
                    <p class="text-xl font-bold text-gray-900">24/7</p>
                    <p class="text-xs text-gray-500 mt-1">Support</p>
                </div>
            </div>
        </div>
    </section>
</template>
