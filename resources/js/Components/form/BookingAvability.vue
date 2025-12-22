<script setup>
import { reactive } from "vue";

const props = defineProps({
    defaultCity: { type: String, default: "Jakarta" },
    showDriverToggle: { type: Boolean, default: true },
    submitText: { type: String, default: "Cek & Pilih Armada" },
});

const emit = defineEmits(["submit"]);

const form = reactive({
    pickup_city: props.defaultCity,
    start_date: "",
    start_time: "09:00",
    end_date: "",
    end_time: "09:00",
    with_driver: true,
});

function submit() {
    // emit payload ke parent
    emit("submit", { ...form });
}
</script>

<template>
    <div
        class="bg-white rounded-3xl shadow-xl border border-gray-100 p-5 md:p-6"
    >
        <h3 class="text-lg font-semibold">Cek Ketersediaan</h3>
        <p class="text-sm text-gray-500 mt-1">Dummy form</p>

        <form
            class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3"
            @submit.prevent="submit"
        >
            <div>
                <label class="text-xs font-medium text-gray-600"
                    >Tanggal mulai</label
                >
                <input
                    v-model="form.start_date"
                    type="date"
                    class="mt-1 w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                />
            </div>

            <div>
                <label class="text-xs font-medium text-gray-600"
                    >Jam mulai</label
                >
                <input
                    v-model="form.start_time"
                    type="time"
                    class="mt-1 w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                />
            </div>

            <div>
                <label class="text-xs font-medium text-gray-600"
                    >Tanggal selesai</label
                >
                <input
                    v-model="form.end_date"
                    type="date"
                    class="mt-1 w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                />
            </div>

            <div>
                <label class="text-xs font-medium text-gray-600"
                    >Jam selesai</label
                >
                <input
                    v-model="form.end_time"
                    type="time"
                    class="mt-1 w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                />
            </div>

            <!-- <div
                v-if="showDriverToggle"
                class="sm:col-span-2 flex items-center justify-between gap-3 bg-gray-50 rounded-2xl p-3"
            >
                <div>
                    <p class="text-sm font-medium">Dengan sopir</p>
                    <p class="text-xs text-gray-500">
                        Centang jika butuh driver.
                    </p>
                </div>
                <input
                    v-model="form.with_driver"
                    type="checkbox"
                    class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                />
            </div> -->

            <button
                type="submit"
                class="sm:col-span-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl text-sm font-semibold tracking-wide"
            >
                {{ submitText }}
            </button>
        </form>
    </div>
</template>
