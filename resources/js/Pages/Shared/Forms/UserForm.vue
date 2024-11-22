<script setup>

import {useForm} from "@inertiajs/vue3";
import {notify} from "@kyvg/vue3-notification";
import {reactive} from "vue";

const props = defineProps({
    user: Object,
});
let userData = props.user;
const form = useForm({
    name: userData.name,
    title: userData.title,
    pronouns: userData.pronouns,
    email: userData.email,
    phone: userData.phone,
    aboutShort: userData.aboutShort,
    aboutLong: userData.aboutLong,
});
const handleSubmit = () => {
    form.post('/userData', {
        onSuccess: () => {
            notify({
                type: 'success',
                title: 'Success',
                text: 'You have updated Your data.'
            })
        },
        onError: () => {
            notify({
                type:'error',
                title:'Error',
                text:'There was an error updating your data. Try again.'
            })
        },
        preserveScroll: true,
    });
};


</script>

<template>
    <form @submit.prevent="handleSubmit" class="space-y-4 mb-5 sm:px-10 md:px-20 xl:px-80 2xl:px-96">
        <div class="flex flex-col">
            <label for="name" class="font-bold">Name</label>
            <input
                id="name"
                type="text"
                v-model="form.name"
                class="border rounded p-2"
            />
            <span v-if="form.errors.name" class="error text-red-700">{{ form.errors.name }}</span>
        </div>

        <div class="flex flex-col">
            <label for="title" class="font-bold">Title</label>
            <input
                id="title"
                type="text"
                v-model="form.title"
                class="border rounded p-2"
            />
            <span v-if="form.errors.title" class="error text-red-700">{{ form.errors.title }}</span>
        </div>

        <div class="flex flex-col">
            <label for="pronouns" class="font-bold">Pronouns</label>
            <input
                id="pronouns"
                type="text"
                v-model="form.pronouns"
                class="border rounded p-2"
            />
            <span v-if="form.errors.pronouns" class="error text-red-700">{{ form.errors.pronouns }}</span>
        </div>

        <div class="flex flex-col">
            <label for="email" class="font-bold">Email</label>
            <input
                id="email"
                type="email"
                v-model="form.email"
                class="border rounded p-2"
            />
            <span v-if="form.errors.email" class="error text-red-700">{{ form.errors.email }}</span>
        </div>

        <div class="flex flex-col">
            <label for="phone" class="font-bold">Phone</label>
            <input
                id="phone"
                type="text"
                v-model="form.phone"
                class="border rounded p-2"
            />
            <span v-if="form.errors.phone" class="error text-red-700">{{ form.errors.phone }}</span>
        </div>

        <div class="flex flex-col">
            <label for="aboutShort" class="font-bold">About Short</label>
            <textarea
                id="aboutShort"
                v-model="form.aboutShort"
                type="tel"
                class="border rounded p-2 min-h-24"
            />
            <span v-if="form.errors.aboutShort" class="error text-red-700">{{ form.errors.aboutShort }}</span>
        </div>

        <div class="flex flex-col">
            <label for="aboutLong" class="font-bold">About Long</label>
            <textarea
                id="aboutLong"
                v-model="form.aboutLong"
                type="tel"
                class="border rounded p-2  min-h-40"
            />
            <span v-if="form.errors.aboutLong" class="error text-red-700">{{ form.errors.aboutLong }}</span>
        </div>

        <button
            type="submit"
            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
        >
            Save
        </button>
    </form>
</template>

<style scoped>
/* Dodaj style, jeśli potrzeba */
</style>
