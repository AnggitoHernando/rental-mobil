<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import Pagination from "@/Layouts/Table/Pagination.vue";
import TableFilters from "@/Layouts/Table/TableFilters.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { items } = defineProps({
    items: Object,
    filters: Object,
});

console.log(items);

const columns = [
    { label: "Kode Mobil", key: "kode_mobil", sortable: true },
    { label: "Brand", key: "brand", sortable: true },
    { label: "Model", key: "model", sortable: true },
    { label: "Tahun", key: "tahun", sortable: true },
    { label: "No Polisi", key: "no_polisi", sortable: true },
    { label: "Warna", key: "warna", sortable: true },
    { label: "Kapasitas Orang", key: "kapasitas", sortable: true },
    { label: "Status", key: "status_aktif", sortable: true },
    { label: "Aksi", key: "actions" },
];
</script>
<template>
    <AdminLayout>
        <Head title="Mobil" />
        <h1 class="text-2xl font-bold mb-4">Mobil</h1>
        <div class="">
            <PrimaryButton>Tambah Mobil</PrimaryButton>
        </div>
        <BaseTable
            :columns="columns"
            :rows="items.data"
            route-name="users.index"
        >
            <template #cell-actions="{ row }">
                <a class="text-blue-600 hover:underline"> Edit </a>
            </template>
        </BaseTable>

        <Pagination :links="items.links" :meta="items.meta" />
    </AdminLayout>
</template>
