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
        <a class=""
           :href="!disabled ? href : null"
           target="_blank">
                <div class=" object-contain">
                    <img :src="icon" :alt="alt" class="min-w-8 min-h-8  max-h-8 max-w-8 lg:max-h-12 lg:max-w-12" />
                </div>
        </a>
</template>

<style scoped>

</style>
