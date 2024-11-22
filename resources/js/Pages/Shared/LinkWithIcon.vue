<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    icon: {
        type: String,
        required: true, // Ścieżka do ikony
    },
    alt: {
        type: String,
        default: "Ikona", // Tekst alternatywny dla ikony
    },
    href: {
        type: String,
        required: true, // Adres URL
    },
    disabled: {
        type: Boolean,
        default: false, // Czy link jest nieaktywny
    },

});
</script>

<template>
        <a class="hover:underline bg-zinc-200 bg-opacity-15"
           :href="!disabled ? href : null"
           target="_blank">
            <div class="flex items-center pt-2">
                <div class="min-w-8 min-h-8 max-h-8 max-w-8 flex-shrink-0 object-contain">
                    <img :src="icon" :alt="alt" class="min-w-8 min-h-8 p-1 max-h-8 max-w-8 text-white bg-slate-200 rounded-full" />
                </div>
                <span class="truncate pl-2">
                    <slot />
                </span>
            </div>
        </a>
</template>

<style scoped>

</style>
