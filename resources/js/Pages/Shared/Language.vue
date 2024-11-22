<script setup>
defineProps({
    language: Object,
});
</script>

<template>
        <div class="flex items-center pt-2 rounded-full p-1 px-2 pb-2 transition-colors duration-500">
            <div class="min-w-5 min-h-5 max-h-8 max-w-8 ">
                <img :src="language.pngPath" class="object-fill"/>
            </div>
            <span class="truncate pl-2">
                {{language.name}}
            </span>
        </div>
</template>

<style scoped>
</style>
