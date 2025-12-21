<template>
    <section class="max-w-7xl mx-auto px-4 py-14">
        <h3 class="text-2xl font-semibold text-center mb-10">
            Mengapa Harus di RentCar?
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                v-for="(item, i) in items"
                :key="i"
                class="bg-white p-6 rounded-2xl shadow-sm hover:shadow transition text-center"
            >
                <h4 class="font-semibold mb-2">{{ item.title }}</h4>
                <p class="text-sm text-gray-500">{{ item.desc }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>
const items = [
    {
        title: "Gas Tanpa Ribet",
        desc: "Booking cepat, tanpa drama. Tinggal chat.",
    },
    { title: "Harga Masuk Akal", desc: "Transparan & bersahabat." },
    { title: "Mobil No Debat", desc: "Bersih, terawat, sesuai ekspektasi." },
    { title: "Siap Kapan Aja", desc: "Admin fast response, mobil ready." },
];
</script>
