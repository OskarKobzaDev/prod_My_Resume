<script setup>
import Karuzela from "@/Pages/Shared/Karuzela.vue"
import LeftPanel from "@/Pages/Shared/LeftPanel.vue";
import ExperienceCard from "@/Pages/Shared/ExperienceCard.vue";
import EducationCard from "@/Pages/Shared/EducationCard.vue";
import {ref} from "vue";
import ContactForm from "@/Pages/Shared/ContactForm.vue";
import {Notifications} from "@kyvg/vue3-notification";
import {Head} from "@inertiajs/vue3";

const isDarkMode = ref(false);
const handleDarkModeUpdate = (value) => {
    isDarkMode.value = value;
};
defineProps({
    user: Object,
    educations: Object,
    experiences: Object,
    skills: Object,
    languages: Object,
    projects: Object,
})

</script>

<template>
    <Head>
        <title>Oskar Kobza - Resume</title>
        <meta name="description" content="Resume of an Entry-Level Web Developer - Oskar Kobza Fullstack Developer" />
        <meta name="keywords" content="resume, portfolio, Oskar Kobza, Laravel, Vue, JS, PHP, React" />
        <meta property="og:title" content="Oskar Kobza - Resume" />
        <meta property="og:description" content="Resume of an Entry-Level Web Developer - Oskar Kobza Fullstack Developer" />
        <meta property="og:image" content="https://oskarkobza.pl/images/resumeapp.PNG" />
        <meta property="og:url" content="https://oskarkobza.pl" />
        <meta name="twitter:title" content="Oskar Kobza - Resume" />
        <meta name="twitter:description" content="Resume of an Entry-Level Web Developer - Oskar Kobza Fullstack Developer" />
        <meta name="twitter:image" content="https://oskarkobza.pl/images/resumeapp.PNG" />
    </Head>
    <div class="flex flex-col h-screen font-poppins md:flex-row md:overflow-hidden ">

        <LeftPanel :languages="languages" :skills="skills" :user="user" @updateDarkMode="handleDarkModeUpdate" />

        <div :class="isDarkMode? 'bg-gray-800 text-white' : 'bg-slate-100 '" class="w-full md:basis-2/3 md:overflow-y-scroll flex flex-col transition-colors duration-500">
            <section class="px-10 md:px-24 lg:px-36 xl:px-36 xl:pr-72 pt-10">
                <h1 class="text-primary text-xl pb-2"><i class="fa-regular fa-user pr-1"/>Intro</h1>
                <p class="break-words text-lg">
                    {{user.aboutLong}}
                </p>
            </section>


            <section class="px-10 md:pl-24 lg:px-36 xl:px-36 xl:pr-72 pt-10">
                <h1 class="text-primary text-xl pb-2"><i class="fas fa-code pr-1"/>Projects</h1>
                <Karuzela :projects="projects"/>
            </section>


            <section class="px-10 md:px-24 lg:px-36 xl:px-36 xl:pr-72 pt-10">
                <h1 class="text-primary text-xl pb-2"><i class="fas fa-briefcase pr-2"/>Experience</h1>
                <div class="flex flex-col space-y-1">
                    <ExperienceCard :experience="experience" v-for="experience in experiences" :isDarkMode="isDarkMode"/>
                </div>
            </section>

            <section class="px-10 md:px-24 lg:px-36 xl:px-36 xl:pr-72 pt-10">
                <h1 class="text-primary text-xl pb-2"><i class="fas fa-graduation-cap pr-1"/>Education</h1>
                <div class="flex flex-col space-y-1">
                    <EducationCard :education="education" v-for="education in educations" :isDarkMode="isDarkMode"/>
                </div>
            </section>

            <section class="px-10 md:px-24 lg:px-36 xl:px-36 xl:pr-72 pt-10 pb-10 ">
                <h1 class="text-primary text-xl pb-2"><i class="fa-regular fa-message pr-1"/>Contact</h1>
                <ContactForm :isDarkMode="isDarkMode"/>
            </section>
        </div>
    </div>
    <notifications position="bottom right" />
</template>

<style scoped>

</style>
