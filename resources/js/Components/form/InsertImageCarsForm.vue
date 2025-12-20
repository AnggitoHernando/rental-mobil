<script setup>
import { ref, computed, reactive } from "vue";
import { usePage } from "@inertiajs/vue3";

const emit = defineEmits(["submit", "cancel"]);

const props = defineProps({
    data: Object,
    images: Object,
    coverImage: Object,
});
const noImage = usePage().props.config.noImage;
const pathCover = props.coverImage?.image_path;
const imageCover = computed(() =>
    props.coverImage ? `/storage/${props.coverImage.image_path}` : noImage
);
const listImages = computed(() => {
    if (props.images && props.images.length > 0) {
        return props.images.map(
            (img) => `storage/${img.image_path}` || noImage
        );
    }
    return [noImage];
});

const cover = ref(null);
const coverPreview = ref(null);

const gallery = ref([]);
const galleryPreview = ref([]);

const showModal = ref(false);
const modalImage = ref(null);

const onCoverChange = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    cover.value = file;
    coverPreview.value = URL.createObjectURL(file);
    form.image[0] = {
        image_path: file,
        cover: "1",
    };
};

const onGalleryChange = (e) => {
    const files = Array.from(e.target.files);

    gallery.value = files;
    galleryPreview.value = files.map((file) => URL.createObjectURL(file));
    files.forEach((file) => {
        form.image.push({
            image_path: file,
            cover: "0",
        });
    });
};

const openModal = (img) => {
    modalImage.value = img;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    modalImage.value = null;
};

const form = reactive({
    car_id: props.data?.id ?? null,
    image: [],
});
const submit = () => {
    emit("submit", {
        data: { ...form },
    });
};
</script>

<template>
    <div class="max-h-[80vh] overflow-y-auto pr-2 space-y-8">
        <div>
            <label class="block text-sm font-semibold mb-2">
                Cover Mobil Tersimpan
            </label>
            <img
                :src="imageCover"
                @click="openModal(imageCover)"
                class="h-32 w-32 object-cover rounded-lg cursor-zoom-in hover:opacity-90 transition"
            />
        </div>
        <div>
            <label class="block text-sm font-semibold mb-2">
                List Foto Tersimpan
            </label>
            <div class="grid grid-cols-3 gap-2">
                <img
                    v-for="(img, i) in listImages"
                    :key="i"
                    :src="img"
                    @click="openModal(img)"
                    class="h-32 w-32 object-cover rounded-lg cursor-zoom-in hover:opacity-90 transition"
                />
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-2">
                Cover Mobil
            </label>

            <div
                class="relative flex items-center justify-center border-2 border-dashed rounded-xl p-6 cursor-pointer hover:border-indigo-500 transition"
            >
                <input
                    type="file"
                    accept="image/*"
                    class="absolute inset-0 opacity-0 cursor-pointer"
                    @change="onCoverChange"
                />

                <div v-if="!coverPreview" class="text-center text-gray-400">
                    <p class="text-sm">Klik untuk upload cover</p>
                    <p class="text-xs">PNG, JPG, WEBP</p>
                </div>

                <img
                    v-else
                    :src="coverPreview"
                    @click.stop="openModal(coverPreview)"
                    class="max-h-48 rounded-lg object-cover cursor-zoom-in"
                />
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">
                Gambar Lainnya
            </label>

            <div
                class="relative border-2 border-dashed rounded-xl p-6 cursor-pointer hover:border-indigo-500 transition"
            >
                <input
                    type="file"
                    accept="image/*"
                    multiple
                    class="absolute inset-0 opacity-0 cursor-pointer"
                    @change="onGalleryChange"
                />

                <p class="text-sm text-gray-400 text-center">
                    Upload beberapa gambar
                </p>
            </div>

            <div
                v-if="galleryPreview.length"
                class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"
            >
                <img
                    v-for="(img, i) in galleryPreview"
                    :key="i"
                    :src="img"
                    @click="openModal(img)"
                    class="h-32 w-full object-cover rounded-lg cursor-zoom-in hover:opacity-90 transition"
                />
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
                Simpan Gambar
            </button>
        </div>
    </div>

    <transition name="fade">
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
            @click.self="closeModal"
        >
            <div class="relative max-w-4xl w-full px-4">
                <button
                    @click="closeModal"
                    class="absolute -top-4 -right-4 bg-white rounded-full p-2 shadow hover:bg-gray-100"
                >
                    ✕
                </button>

                <img
                    :src="modalImage"
                    class="max-h-[80vh] w-full object-contain rounded-xl bg-black"
                />
            </div>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
