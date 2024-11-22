<script setup>
import {useForm} from "@inertiajs/vue3";
import { useNotification } from "@kyvg/vue3-notification";
const { notify }  = useNotification();

defineProps({
    isDarkMode: Boolean,
    errors: Object,
})

const form = useForm({
    name: '',
    email: '',
    message: '',
});

// Obsługa wysyłania formularza
const handleSubmit = () => {
    form.post('/contact', {
        onSuccess: () => {
            form.reset(); // Resetuje formularz po sukcesie
            notify({
                type: 'success',
                title: 'Success',
                text: 'You have send me a massage! :)'
            })
        },
        onError: () => {
            notify({
                type:'error',
                title:'Error',
                text:'There was an error seending your message. Try again.'
            })
        },
        preserveScroll: true,
    });
};
</script>

<template>
        <div
            :class="isDarkMode ? 'bg-slate-700 text-white' : 'bg-slate-200 hover:bg-slate-400/50 text-gray-600'"
            class="w-full rounded-2xl p-4 place-self-end bg-slate-200/90 transition-colors duration-500"
        >
            <h1 class="text-xl text-center pb-1">Please leave me a message.</h1>
            <form @submit.prevent="handleSubmit" class="flex flex-col space-y-4">
                <input type="text" v-model="form.name" placeholder="Your Name" class="border bg-slate-100 rounded px-4 py-2 text-gray-600" />
                <div v-if="form.errors.name" v-text="form.errors.name" :class="isDarkMode? 'text-red-500' : 'text-red-700'" class="text-sm mt-1"></div>
                <input type="email" v-model="form.email" placeholder="Your Email" class="border bg-slate-100 rounded px-4 py-2 text-gray-600"/>
                <div v-if="form.errors.email" v-text="form.errors.email" :class="isDarkMode? 'text-red-500' : 'text-red-700'" class="text-sm mt-1"></div>
                <textarea v-model="form.message" placeholder="Your Message" class="h-40 border bg-slate-100 rounded px-4 py-2 text-gray-600"></textarea>
                <div v-if="form.errors.message" v-text="form.errors.message" :class="isDarkMode? 'text-red-500' : 'text-red-700'" class="text-sm mt-1"></div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Send</button>
            </form>

        </div>
</template>

<style scoped>

</style>
