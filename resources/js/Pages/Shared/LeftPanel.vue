<script setup>

import Language from "@/Pages/Shared/Language.vue";
import LinkWithIcon from "@/Pages/Shared/LinkWithIcon.vue";
import SkillLabel from "@/Pages/Shared/SkillLabel.vue";
import IconLink from "@/Pages/Shared/IconLink.vue";
import { ref, defineEmits } from 'vue';

defineProps({
    user: Object,
    skills: Object,
    languages: Object,
})

const isDarkMode = ref(false);
const emit = defineEmits(['updateDarkMode']);

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    emit('updateDarkMode', isDarkMode.value); // Emitowanie zmiany do rodzica
};

</script>

<template>
    <div :class="isDarkMode ? 'bg-slate-700 text-white':'bg-slate-200 text-black'"  class="bg-slate-200/90 w-full md:w-1/3 md:h-full flex flex-col transition-colors duration-500">

        <section class="pl-10 pt-4 lg:pt-10 flex flex-col">
            <div class="flex justify-between items-center pr-10">
                <div class="max-w-[120px] max-h-[120px] float-left mr-4 mb-4 bg-primary rounded-full">
                    <img :src="user.avatarPath" alt="Logo" class="p-1 rounded-full" >
                </div>
                <button @click="toggleDarkMode" :class="isDarkMode ? 'bg-gray-600 hover:bg-gray-500':' bg-gray-300 hover:bg-gray-400'" class="items-center min-h-12 min-w-18 max-h-12 rounded-full dark:bg-gray-700">
                    <div class="px-3 py-1">
                        {{ isDarkMode? 'LightMode' : 'DarkMode'}}
                        <i class="fa-solid" :class="isDarkMode ? 'fa-sun text-yellow-400' : 'fa-moon text-gray-600'"></i>
                    </div>
                </button>
            </div>

            <h1 class="text-4xl italic ">{{ user.name }}</h1>
            <p :class="isDarkMode? 'text-gray-300' : 'text-gray-900'" class="pr-14 xl:pr-40">{{ user.title }}</p>
            <p class="text-gray-400">{{ user.pronouns }}</p>
        </section>

        <section class="px-10 pt-4 md:pt-2 lg:pt-4 ">
            <h1 class="text-primary text-gray-400 text-xl pb-2"><i class=" fa-regular fa-face-smile pr-1"/>About</h1>
            <p :class="isDarkMode? 'text-gray-300' : 'text-gray-900'" class="break-words text-md pr-14 md:pr-4 xl:pr-40">
                {{user.aboutShort}}
            </p>
        </section>

        <section class="pl-10 pt-4 md:pt-2 lg:pt-4">
            <h1 class="text-primary text-xl"><i class="fa-regular fa-message pr-1"/>Contact</h1>
            <LinkWithIcon href="mailto:oskarkobza@gmail.com?subject=Zapytanie&body=Hi Oskar, I'd like to..." icon="/images/mail.png">
                {{ user.email }}</LinkWithIcon>
            <LinkWithIcon href="" icon="/images/phone.png" :disabled="true">
                {{user.phone}}
            </LinkWithIcon>
        </section>

        <section class="pl-10 pt-4 md:pt-2 lg:pt-4">
            <h1 class="text-primary text-xl pb-1"><i class="fa-solid fa-chart-column pr-1"/>Skills</h1>
            <div class="flex pt-1 pr-10 xl:pr-20 flex-wrap">
                <SkillLabel :skill="skill" v-for="skill in skills"/>
            </div>

        </section>
        <section class="pl-10 pt-6 md:pt-2 lg:pt-6 overflow-x-auto">
            <h1 class="text-primary text-xl"><i class="fa-solid fa-comments pr-1"/>Languages</h1>
            <div class="flex space-x-1">
                    <Language :language="language" v-for="language in languages" :class="isDarkMode? 'text-white bg-gray-500' : 'text-black bg-white'"/>
            </div>

        </section>
        <section class="pt-4 md:pt-1 pb-1 mt-auto flex justify-between items-center flex-shrink">
            <p class="pl-10">
                &copy; Oskar Kobza
            </p>
            <div class="flex space-x-1 pr-4">
                <IconLink href="https://www.instagram.com/kobzon99/" icon="/images/ig.png"/>
                <IconLink :class="isDarkMode? 'bg-slate-300 rounded-full' : ''" href="https://github.com/Kobzon99" icon="/images/ghub1.png"/>
                <IconLink href="https://www.linkedin.com/in/oskarkobza/" icon="/images/lin.png"/>
                <IconLink href="https://www.facebook.com/oskar.kobza.1" icon="/images/fb.png"/>
            </div>
        </section>


    </div>
</template>

<style scoped>

</style>
