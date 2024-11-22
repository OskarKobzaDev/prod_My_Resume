<script setup>

defineProps({
    isDarkMode: Boolean,
    education: Object,
})
</script>

<template>
    <div :class="isDarkMode? 'bg-slate-700 text-white hover:bg-slate-600' : 'bg-slate-200 hover:bg-slate-400/50 text-gray-600'" class="flex rounded-2xl transition-colors duration-500">
        <div class="min-w-20 max-w-20 min-h-20 max-h-20 pt-1 pl-2">
            <img :src="education.iconPath" class="object-fill">
        </div>
        <div class="px-4 pb-4">
            <h1 class="pt-2 text-lg">{{ education.name }}</h1>
            <div class="flex py-2 items-center">
                <i class="fas fa-calendar-alt text-gray-500 pr-2"></i>
                <p>{{ education.date }}</p>
                <i class="fas fa-map-marker-alt text-gray-500 px-2"></i>
                <p>{{ education.place }}</p>
            </div>
            <p :class="isDarkMode? 'text-white' : 'text-gray-700'">
                {{education.description}}
            </p>
        </div>

    </div>
</template>

<style scoped>

</style>
