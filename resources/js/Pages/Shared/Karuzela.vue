<script setup>
import { ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css/bundle';

// Props (lub dane do testowania)
defineProps({
    projects: Object,
})

// Konfiguracja modułów i autoplay
const modules = [Pagination, Autoplay, Navigation];
const autoplayConfig = { delay: 4000, disableOnInteraction: true };
</script>


<template>
    <swiper
        :modules="modules"
        :slides-per-view="1"
        :space-between="10"
        pagination
        navigation
        :autoplay="autoplayConfig"
        class="main-swiper px-10"
    >
        <!-- Główne slajdy -->
        <swiper-slide
            v-for="project in projects"
            :key="project.id"
            class="project-slide"
        >
            <div class="bg-gray-300 h-96 w-full rounded-lg shadow-lg flex flex-col">
                <!-- Zagnieżdżony pionowy Swiper -->
                <swiper
                    :modules="[Pagination]"
                    direction="vertical"
                    :slides-per-view="1"
                    :space-between="10"
                    pagination
                    class="nested-swiper w-full"
                    :style="{ backgroundImage: `url(${project.pngPath})` }"
                >
                    <!-- Screen aplikacji -->
                    <swiper-slide class="w-full h-full">
                        <h3 class="text-lg pl-2 text-white md:text-2xl font-bold bg-slate-400/70">
                            {{ project.name }} - {{ project.descriptionShort}}
                        </h3>
                        <p class="text-2xl md:text-4xl text-red-500 pt-2 place-self-center font-bold text-center ">
                            Swipe me up<i class="pl-3 fa-solid fa-hand-point-up"></i>
                        </p>
                    </swiper-slide>

                    <!-- Opis technologii -->
                    <swiper-slide
                        class="min-w-full min-h-full flex items-center justify-center bg-gray-700/90 rounded-lg"
                    >
                        <div class="h-full w-full px-3 2xl:px-32 text-center text-white">
                            <h3 class="sm:pt-3 xl:pt-4 text-2xl font-bold">{{ project.name }}</h3>
                            <p class="mt-2  text-md xl:text-lg">{{ project.descriptionLong }}</p>
                            <ul class="mt-3 xl:mt-4  text-start text-sm md:text-md lg:text-lg list-disc list-inside">
                                <li class="flex">
                                    Repo: <a target="_blank" :href="project.pathGitHub" class="pl-1 hover:underline hover:text-blue-500">{{ project.pathGitHub }}</a>
                                </li>
                                <li class="flex">
                                    Demo: <a target="_blank" :href="project.pathUrl" class="pl-1 hover:underline hover:text-blue-500">{{ project.pathUrl }}</a>
                                </li>
                            </ul>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </swiper-slide>
    </swiper>
</template>

<style scoped>
.nested-swiper {
    --swiper-pagination-right: 50px;
    --swiper-pagination-color: rgba(255, 99, 71, 1);
    background-size: cover;
    background-position:initial;
    background-repeat: no-repeat;
    height: 100%;
}
</style>
