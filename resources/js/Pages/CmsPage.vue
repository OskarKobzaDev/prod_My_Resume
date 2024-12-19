<script setup>

import UserForm from "@/Pages/Shared/Forms/UserForm.vue";
import SkillsForm from "@/Pages/Shared/Forms/SkillsForm.vue";
import LanguageForm from "@/Pages/Shared/Forms/LanguageForm.vue";
import {Notifications} from "@kyvg/vue3-notification";
import EducationForm from "@/Pages/Shared/Forms/EducationForm.vue";
import ExperienceForm from "@/Pages/Shared/Forms/ExperienceForm.vue";
import ProjectsForm from "@/Pages/Shared/Forms/ProjectsForm.vue";
import {Head} from "@inertiajs/vue3";

defineProps({
    user: Object,
    skills: Object,
    languages: Object,
    educations: Object,
    experiences: Object,
    projects: Object,
})

</script>

<template>
    <Head>
        <title>Oskar Kobza - Resume CMS</title>
    </Head>
    <div class="flex flex-col min-w-full w-full max-w-screen bg-zinc-200 overflow-hidden">
        <h1 class="text-3xl font-bold p-4 border-b-1 border-black">
            CMS for Resume Site
        </h1>

        <hr class="border-t-black"/>

        <section id="userEditSection" class="px-4 ">
            <h1 class="text-2xl font-bold p-4 border-b-gray-400">User</h1>
            <UserForm :user="user"/>
        </section>

        <hr class="border-t-black"/>

        <section id="skillsEditSection" class="px-4">
            <h1 class="text-2xl font-bold p-4 border-b-gray-400">Skills</h1>
            <SkillsForm :skills="skills"/>
        </section>

        <hr class="border-t-black"/>

        <section id="languagesEditSection" class="px-4">
            <h1 class="text-2xl font-bold p-4 border-b-gray-400">Languages</h1>
            <LanguageForm :languages="languages"/>
        </section>

        <hr class="border-t-black"/>

        <section id="EducationEditSection" class="px-4">
            <h1 class="text-2xl font-bold p-4 border-b-gray-400">Education</h1>
            <EducationForm :educations="educations"/>
        </section>

        <hr class="border-t-black"/>

        <section id="ExperienceEditSection" class="px-4">
            <h1 class="text-2xl font-bold p-4 border-b-gray-400">Experience</h1>
            <ExperienceForm :experiences="experiences"/>
        </section>

        <hr class="border-t-black"/>

        <section id="ExperienceEditSection" class="px-4">
            <h1 class="text-2xl font-bold p-4 border-b-gray-400">Projects</h1>
            <ProjectsForm :projects="projects"/>
        </section>

    </div>
    <notifications position="bottom right" />
</template>

<style scoped>
/* Dodaj własne style, jeśli potrzeba */
</style>
