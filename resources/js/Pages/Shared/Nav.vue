<script setup>

import NavLink from "@/Pages/Shared/NavLink.vue";

</script>

<template>
    <nav class="ml-6">
        <ul class=" items-center md:space-x-4 lg:space-x-14 flex list-inside">
            <li><NavLink href="/" :active="$page.component === 'HomePage'">Strona główna</NavLink></li>
            <li><NavLink href="/docs" :active="$page.component === 'Users/Index'">Dokumenty</NavLink></li>
            <li><NavLink href="/projects" :active="$page.component === 'Settings'">Projekty</NavLink></li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
