<script setup>
import { reactive } from "vue";

const emit = defineEmits(["cancel"]);
const form = reactive({
    kode_mobil: "",
    brand: "",
    model: "",
    tahun: "",
    no_polisi: "",
    warna: "",
});

const submit = () => {
    console.log(form);
};
</script>

<template>
    <div class="space-y-5">
        <!-- Kode Mobil -->
        <div>
            <label class="label-new">Kode Mobil</label>
            <input
                v-model="form.kode_mobil"
                type="text"
                placeholder="MBL-001"
                class="input-new"
            />
        </div>

        <!-- Brand & Model -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label-new">Brand</label>
                <input
                    v-model="form.brand"
                    type="text"
                    placeholder="Toyota"
                    class="input-new"
                />
            </div>

            <div>
                <label class="label-new">Model</label>
                <input
                    v-model="form.model"
                    type="text"
                    placeholder="Avanza"
                    class="input-new"
                />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label-new">Tahun</label>
                <input
                    v-model="form.tahun"
                    type="text"
                    placeholder="2023"
                    class="input-new"
                />
            </div>

            <div>
                <label class="label-new">Warna</label>
                <input
                    v-model="form.warna"
                    type="text"
                    placeholder="Hitam Metalik"
                    class="input-new"
                />
            </div>
        </div>

        <div>
            <label class="label-new">No Polisi</label>
            <input
                v-model="form.no_polisi"
                type="text"
                placeholder="B 1234 XYZ"
                class="input-new uppercase"
            />
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <button
                type="button"
                class="rounded-xl px-4 py-2 text-sm text-gray-500 hover:bg-gray-100"
                @click="emit('cancel')"
            >
                Cancel
            </button>

            <button
                @click="submit"
                class="rounded-xl bg-gradient-to-r from-blue-500 to-green-600 px-5 py-2 text-sm font-semibold text-white shadow-lg hover:scale-[1.02] transition"
            >
                Simpan Mobil
            </button>
        </div>
    </div>
</template>
