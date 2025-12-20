<script setup>
import { reactive, computed } from "vue";

const props = defineProps({
    car: {
        type: Object,
        default: null,
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});
const emit = defineEmits(["submit", "cancel"]);
const form = reactive({
    id: props.car?.id ?? null,
    kode_mobil: props.car?.kode_mobil ?? "",
    brand: props.car?.brand ?? "",
    model: props.car?.model ?? "",
    tahun: props.car?.tahun ?? "",
    no_polisi: props.car?.no_polisi ?? "",
    kapasitas: props.car?.kapasitas ?? "",
    warna: props.car?.warna ?? "",
});

const isEdit = computed(() => !!form.id);

const submit = () => {
    emit("submit", {
        isEdit: isEdit.value,
        data: { ...form },
    });
};
</script>

<template>
    <div class="space-y-5">
        <div>
            <label class="label-new">Kode Mobil</label>
            <input
                v-model="form.kode_mobil"
                type="text"
                placeholder="MBL-001"
                class="input-new"
            />
            <p v-if="props.errors.kode_mobil" class="mt-1 text-xs text-red-500">
                {{ props.errors.kode_mobil }}
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label-new">Brand</label>
                <input
                    v-model="form.brand"
                    type="text"
                    placeholder="Toyota"
                    class="input-new"
                />
                <p v-if="props.errors.brand" class="mt-1 text-xs text-red-500">
                    {{ props.errors.brand }}
                </p>
            </div>

            <div>
                <label class="label-new">Model</label>
                <input
                    v-model="form.model"
                    type="text"
                    placeholder="Avanza"
                    class="input-new"
                />
                <p v-if="props.errors.model" class="mt-1 text-xs text-red-500">
                    {{ props.errors.model }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label-new">Tahun</label>
                <input
                    v-model="form.tahun"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    maxlength="4"
                    @input="form.tahun = form.tahun.replace(/\D/g, '')"
                    placeholder="2023"
                    class="input-new"
                />
                <p v-if="props.errors.tahun" class="mt-1 text-xs text-red-500">
                    {{ props.errors.tahun }}
                </p>
            </div>

            <div>
                <label class="label-new">Warna</label>
                <input
                    v-model="form.warna"
                    type="text"
                    placeholder="Hitam Metalik"
                    class="input-new"
                />
                <p v-if="props.errors.warna" class="mt-1 text-xs text-red-500">
                    {{ props.errors.warna }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label-new">Kapasitas</label>
                <input
                    v-model="form.kapasitas"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    maxlength="4"
                    @input="form.kapasitas = form.kapasitas.replace(/\D/g, '')"
                    placeholder="4"
                    class="input-new"
                />
                <p
                    v-if="props.errors.kapasitas"
                    class="mt-1 text-xs text-red-500"
                >
                    {{ props.errors.kapasitas }}
                </p>
            </div>
            <div>
                <label class="label-new">No Polisi</label>
                <input
                    v-model="form.no_polisi"
                    type="text"
                    placeholder="B 1234 XYZ"
                    class="input-new uppercase"
                />
                <p
                    v-if="props.errors.no_polisi"
                    class="mt-1 text-xs text-red-500"
                >
                    {{ props.errors.no_polisi }}
                </p>
            </div>
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
