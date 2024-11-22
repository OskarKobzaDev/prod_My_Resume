<script setup>
import {ref} from "vue";

defineProps({
    skill: Object,
})


</script>

<template>
        <div
            :style="{ backgroundColor: skill.colorHex }"
            class="rounded flex grow min-w-12 max-w-16 min-h-8 max-h-12 mb-1 ml-1 items-center justify-center transition-colors duration-500">
            <p class="text-md ">
                {{skill.name}}
            </p>
        </div>
</template>

<style scoped>

</style>
