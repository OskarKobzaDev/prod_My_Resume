<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    active: Boolean,
})
</script>

<template>
    <Link class=" hover:underline" :class="{ 'font-bold underline': active }" >
        <slot/>
    </Link>
</template>

<style scoped>

</style>
