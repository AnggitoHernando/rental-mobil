<script setup>
const emit = defineEmits(["submit", "cancel"]);
</script>
<template>
    <div class="space-y-5">
        <div class="flex items-center space-x-4">
            <!-- Select jenis harga -->
            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="jenisHarga"
                    >Jenis Harga</label
                >
                <select
                    id="jenisHarga"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-gray-800 focus:border-gray-600 focus:ring-1 focus:ring-gray-400 transition duration-150"
                >
                    <option value="" disabled selected>
                        Pilih jenis harga
                    </option>
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
            </div>

            <!-- Harga Brutto -->
            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="hargaBrutto"
                    >Harga Brutto</label
                >
                <input
                    id="hargaBrutto"
                    type="number"
                    placeholder="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:border-gray-600 focus:ring-1 focus:ring-gray-400 transition duration-150"
                />
            </div>

            <!-- Diskon -->
            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="diskon"
                    >Diskon (%)</label
                >
                <input
                    id="diskon"
                    type="number"
                    placeholder="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:border-gray-600 focus:ring-1 focus:ring-gray-400 transition duration-150"
                />
            </div>

            <!-- Harga Netto -->
            <div class="flex-1">
                <label
                    class="block text-gray-700 text-sm font-medium mb-1"
                    for="hargaNetto"
                    >Harga Netto</label
                >
                <input
                    id="hargaNetto"
                    type="number"
                    placeholder="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:border-gray-600 focus:ring-1 focus:ring-gray-400 transition duration-150"
                />
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div>
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-150"
            >
                <!-- Lucide Icon Save -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>
                Simpan
            </button>
        </div>
    </div>
</template>
