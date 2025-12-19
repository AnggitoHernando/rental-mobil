<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { PenLine, Trash2, ImagePlus, DollarSign } from "lucide-vue-next";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import Pagination from "@/Layouts/Table/Pagination.vue";
import TableFilters from "@/Layouts/Table/TableFilters.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, getCurrentInstance, watch } from "vue";
import Modal from "@/Components/NewModal.vue";
import CreateCarsForm from "@/Components/Form/CreateCarsForm.vue";
import ActionButton from "@/Components/ButtonWithIcon.vue";
import { result } from "lodash";

const { appContext } = getCurrentInstance();
const swal = appContext.config.globalProperties.$swal;

const showModal = ref(false);
const { items } = defineProps({
    items: Object,
    filters: Object,
});
const selectedCar = ref(null);
const errors = ref({});

const openCreate = () => {
    selectedCar.value = null;
    showModal.value = true;
};

const openEdit = (car) => {
    selectedCar.value = car;
    errors.value = "";
    showModal.value = true;
};

const deleteRow = (item) => {
    swal.fire({
        title: `Hapus Mobil Kode "${item.kode_mobil}" dengan Brand ${item.brand} dan Model ${item.model}?`,
        text: "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("mobil.destroy", item.id), {
                onSuccess: () => {
                    swal.fire("Berhasil", "Data berhasil dihapus", "success");
                },
                onError: (err) => {
                    console.log(err);
                    errors.value = err;
                    swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Terjadi Kesalahan Saat Hapus",
                    });
                },
            });
        }
    });
};

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

const handleSubmit = ({ isEdit, data }) => {
    if (isEdit) {
        router.put(route("mobil.update", data.id), data, {
            onSuccess: () => {
                swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Data mobil berhasil diubah",
                    timer: 1500,
                    showConfirmButton: false,
                });
                showModal.value = false;
            },
            onError: (err) => {
                console.log(err);
                errors.value = err;
                swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Periksa kembali data yang kamu input",
                });
            },
            onFinish: () => {},
        });
    } else {
        router.post(route("mobil.store"), data, {
            onSuccess: () => {
                swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Data mobil berhasil disimpan",
                    timer: 1500,
                    showConfirmButton: false,
                });
                showModal.value = false;
            },
            onError: (err) => {
                console.log(err);
                errors.value = err;
                swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Periksa kembali data yang kamu input",
                });
            },
            onFinish: () => {},
        });
    }
};
const search = ref("");

watch(search, (value) => {
    router.get(
        route("mobil.index"),
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>
<template>
    <AdminLayout>
        <Head title="Mobil" />
        <h1 class="text-2xl font-bold mb-4">Mobil</h1>
        <div class="mb-2 flex flex-col sm:flex-row justify-end">
            <PrimaryButton @click="openCreate">Tambah Mobil</PrimaryButton>
        </div>

        <div class="flex items-center justify-between mb-4">
            <TableFilters
                v-model="search"
                placeholder="Cari mobil, brand, plat..."
            />
        </div>
        <BaseTable
            :columns="columns"
            :rows="items.data"
            :filters="filters"
            route-name="mobil.index"
        >
            <template #cell-actions="{ row }">
                <div class="flex items-center gap-2">
                    <ActionButton
                        title="Edit Data"
                        class="bg-blue-700"
                        @click="openEdit(row)"
                    >
                        <template #icon>
                            <PenLine class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                    <ActionButton title="Tambah Gambar" class="bg-yellow-500">
                        <template #icon>
                            <ImagePlus class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                    <ActionButton title="Tambah Harga" class="bg-green-500">
                        <template #icon>
                            <DollarSign class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
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
        <Pagination :links="items.links" :meta="items" />
        <Modal :show="showModal" @close="showModal = false">
            <template #title>
                <h2 class="text-lg font-semibold">
                    {{ selectedCar ? "Edit Mobil" : "Tambah Mobil" }}
                </h2>
            </template>

            <CreateCarsForm
                :car="selectedCar"
                :errors="errors"
                @submit="handleSubmit"
                @cancel="showModal = false"
            />
        </Modal>
    </AdminLayout>
</template>
