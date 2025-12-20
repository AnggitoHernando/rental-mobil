<script setup>
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

defineProps({
    show: {
        type: Boolean,
        required: true,
    },
    width: {
        type: String,
        default: "max-w-lg",
    },
});

const emit = defineEmits(["close"]);
</script>

<template>
    <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-50" @close="() => {}">
            <!-- Backdrop -->
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/50" />
            </TransitionChild>

            <div class="fixed inset-0 flex items-center justify-center p-4">
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 scale-95"
                    enter-to="opacity-100 scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 scale-100"
                    leave-to="opacity-0 scale-95"
                >
                    <DialogPanel
                        :class="`w-full ${width} rounded-lg bg-white p-6 shadow-xl`"
                    >
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-4">
                            <slot name="title" />
                            <button
                                type="button"
                                @click="$emit('close')"
                                class="text-gray-400 hover:text-gray-600"
                            >
                                ✕
                            </button>
                        </div>

                        <!-- Content -->
                        <slot />

                        <!-- Footer -->
                        <!-- <div class="mt-6 text-right">
                            <button
                                type="button"
                                @click="$emit('close')"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm hover:bg-gray-300"
                            >
                                Close
                            </button>
                        </div> -->
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
