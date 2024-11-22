<script setup>

import {Head} from "@inertiajs/vue3";
import {computed, ref, onMounted, onUnmounted } from "vue";
import Nav from "@/Pages/Shared/Nav.vue";
import NavLink from "@/Pages/Shared/NavLink.vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage();

const activePage = computed(() => {
    const activeLink = [
        { name: "Home", route: "/" },
        { name: "Dokumenty", route: "/docs" },
        { name: "Projekty", route: "/projects" },
    ].find((link) => link.route === page.props.url); // Użyj page.props.url

    return activeLink ? activeLink.name : "Nieznana Strona";
});

const menuOpen = ref(false);
const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
};

const isScrolled = ref(false);
const handleScroll = () => {
    isScrolled.value = window.scrollY > 50; // Gdy scroll > 50px, ustaw opacity
};
onMounted(() => {
    window.addEventListener("scroll", handleScroll); // Obsługa scrollowania
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll); // Usuń event listener
});


console.log(page.props.url);
</script>

<template>
    <Head>
        <title>Resume...</title>
        <meta type="description" content="Oskar's Kobza resume website."  head-key="description">
    </Head>


<div class="flex flex-col min-h-full bg-gray-200">
    <section class="bg-slate-700 sticky top-0" :class="{'opacity-90': isScrolled}">
        <header class="flex items-center justify-between p-4 mx-4 text-lg md:text-2xl font-bold">
<!--            Tutaj blok lewy powitanie usera-->
            <div class="pt-2 pb-2 md:pt-5 md:pb-5">
                <h1 class="md:pl-6">
                    Witaj!
                </h1>
            </div>

<!--            Tutaj blok środkowy(tytuł storony lub nav)-->

            <div class="pt-2 pb-2 md:pt-5 md:pb-5">
                <Nav class="hidden md:block"/>
                <p class="md:hidden"> {{ $page.props.name }}</p>
            </div>

<!--            Tutaj blok prawy link zaloguj lub hamburger-->
            <div class="pt-2 pb-2 md:pt-5 md:pb-5">
                <NavLink class="hidden md:block">Zaloguj się</NavLink>
                <button @click="toggleMenu" class="text-white focus:outline-none md:hidden">
                    <!-- Ikona hamburgera -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>


<!--            Tło "pod" szufladą-->
            <div
                v-if="menuOpen"
                class="fixed inset-0 bg-black/50 z-40"
                @click="toggleMenu"
            ></div>


<!--            Szuflada z opcjami mobilnymi-->
            <Transition
                enter-from-class="transform translate-x-full duration-500"
                enter-to-class="transform translate-x-0 duration-500"
                leave-from-class="transform translate-x-0 duration-500"
                leave-to-class="transform translate-x-full duration-500"
            >
            <div
                v-if="menuOpen"
                class="fixed right-0 top-0 h-full w-52 bg-sky-900 text-white shadow-lg z-50 transform transition-transform"
            >
                <div class="flex flex-col space-y-4 p-6 px-10">
                    <button @click="toggleMenu" class="text-white mr-auto w-10 h-10 self-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <NavLink href="/" :active="$page.component === 'HomePage'">Strona główna</NavLink>
                    <NavLink href="/projects" :active="$page.component === 'Projects'">Projekty</NavLink>
                    <NavLink href="/docs" :active="$page.component === 'Docs'">Dokumenty</NavLink>
                    <NavLink href="/contact" :active="$page.component === 'Contact'">Kontakt</NavLink>
                    <NavLink href="/login">Zaloguj się</NavLink>
                </div>
            </div>
            </Transition>
        </header>
    </section>

    <main class="md:flex-grow ">
        <slot/>
    </main>

    <footer class="max-h-24 bg-gray-300 text-center">
        <p class="justify-center">
            &copy; Oskar Kobza
        </p>
    </footer>

</div>

</template>

<style scoped>

</style>
