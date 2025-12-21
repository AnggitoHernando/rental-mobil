<script setup>
import { reactive, computed, watch } from "vue";
const emit = defineEmits(["submit", "cancel", "delete"]);
import InputPrices from "../InputPrices.vue";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import ActionButton from "../ButtonWithIcon.vue";
import { Trash2 } from "lucide-vue-next";
import { formatRupiah } from "../utils/currency";

const props = defineProps({
    data: {
        type: Object,
        default: null,
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
    dataPrice: {
        type: Object,
        default: null,
    },
});

const form = reactive({
    id: null,
    car_id: props.data?.id ?? null,
    price_type: "",
    bruto: 0,
    disc: 0,
    netto: 0,
});

const columns = [
    { label: "Jenis Harga", key: "price_type", sortable: false },
    { label: "Bruto", key: "bruto", sortable: false },
    { label: "Diskon(%)", key: "disc", sortable: false },
    { label: "Netto", key: "netto", sortable: false },
    { label: "Aksi", key: "actions" },
];
const submit = () => {
    emit("submit", {
        data: { ...form },
    });
};

const deleteRow = (row) => {
    emit("delete", {
        item: row,
    });
};

watch(
    () => [form.bruto, form.disc],
    () => {
        if (Number(form.disc) > 100) form.disc = 100;
        form.netto = form.bruto - Math.round(form.bruto * (form.disc / 100));
    },
    { immediate: true }
);
</script>
<template>
    <div class="space-y-5">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="price_type"
                    >Jenis Harga</label
                >
                <select
                    v-model="form.price_type"
                    id="price_type"
                    class="w-full input-new"
                >
                    <option value="" disabled selected>
                        Pilih jenis harga
                    </option>
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
                <p
                    v-if="props.errors.price_type"
                    class="mt-1 text-xs text-red-500"
                >
                    {{ props.errors.price_type }}
                </p>
            </div>

            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="hargaBrutto"
                    >Harga Brutto</label
                >
                <InputPrices v-model="form.bruto" />
                <p v-if="props.errors.bruto" class="mt-1 text-xs text-red-500">
                    {{ props.errors.bruto }}
                </p>
            </div>

            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="diskon"
                    >Diskon (%)</label
                >
                <input
                    v-model="form.disc"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    placeholder="0"
                    maxlength="3"
                    @input="
                        form.disc = Number(form.disc.replace(/\D/g, '')) || 0
                    "
                    @change="if (Number(form.disc) > 100) form.disc = 100;"
                    class="input-new"
                />
                <p v-if="props.errors.disc" class="mt-1 text-xs text-red-500">
                    {{ props.errors.disc }}
                </p>
            </div>

            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="hargaNetto"
                    >Harga Netto</label
                >
                <InputPrices v-model="form.netto" :disabled="true" />
                <p v-if="props.errors.netto" class="mt-1 text-xs text-red-500">
                    {{ props.errors.netto }}
                </p>
            </div>
        </div>

        <div class="flex justify-end">
            <button
                @click="submit"
                class="rounded-xl bg-gradient-to-r from-blue-500 to-green-600 px-5 py-2 text-sm font-semibold text-white shadow-lg hover:scale-[1.02] transition"
            >
                Simpan Harga
            </button>
        </div>
        <BaseTable
            :columns="columns"
            route-name="mobil.price"
            :rows="props.dataPrice"
        >
            <template #cell-bruto="{ row }">
                {{ formatRupiah(row.bruto) }}
            </template>

            <template #cell-netto="{ row }">
                {{ formatRupiah(row.netto) }}
            </template>
            <template #cell-actions="{ row }">
                <div class="flex items-center gap-2">
                    <ActionButton
                        title="Hapus Data"
                        class="bg-red-500"
                        @click="deleteRow(row)"
                    >
                        <template #icon>
                            <Trash2 class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                </div>
            </template>
        </BaseTable>
    </div>
</template>
