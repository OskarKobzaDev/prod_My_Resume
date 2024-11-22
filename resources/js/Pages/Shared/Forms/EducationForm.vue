<script setup>
import EducationCard from "@/Pages/Shared/EducationCard.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import {notify} from "@kyvg/vue3-notification";

defineProps({
    educations: Array,
})

const form = useForm({
    id: null,
    name: "",
    place:"",
    date:"",
    description: "",
    icon: null,
});

const isAddEditModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const educationToDelete = ref(null);

const openAddEditModal = (education = null) => {
    if (education) {
        form.id = education.id;
        form.name = education.name;
        form.description = education.description;
        form.place = education.place;
        form.date = education.date;
        form.icon = null;
    } else {
        form.reset();
    }
    isAddEditModalOpen.value = true;
};
const educationDeleteModal = (education) => {
    educationToDelete.value = education;
    isDeleteModalOpen.value = true;
};
const saveEducation = () => {
    if (form.id) {
        form.patch(route("educations.patch", form.id), {
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                educationToDelete.value = null;
            },
            onError: (errors) => {
                console.error("Error while editing:", errors);
            },
            preserveScroll: true,
        });
    }
    else{
        form.post(route("educations.store"), {
            onSuccess: () => {
                notify({
                    type: "success",
                    title: "Success",
                    text: `Language ${form.id ? "updated" : "added"} successfully.`,
                });
                isAddEditModalOpen.value = false;
            },
            onError: () => {
                notify({
                    type: "error",
                    title: "Error",
                    text: "Something went wrong. Try again.",
                });
            },
            preserveScroll: true,
        });
    }
}
const deleteEducation = () => {
    if (educationToDelete.value) {
        form.delete(route("educations.destroy", educationToDelete.value.id), {
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                educationToDelete.value = null;
            },
            onError: (errors) => {
                console.error("Error while deleting:", errors);
            },
            preserveScroll: true,
        });
    }
};
</script>

<template>
<div class=" sm:px-10 md:px-20 mb-5 xl:px-72 2xl:px-96">
    <button @click="openAddEditModal" class="btn btn-primary mb-4">Add New Education</button>

    <div v-for="education in educations" class="mb-2 bg-slate-200 hover:bg-slate-400/50 text-gray-600 flex rounded-2xl transition-colors duration-500">
        <div class="min-w-20 max-w-20 min-h-20 max-h-20 pt-1 pl-2">
            <img :src="education.iconPath" class="object-fill">
        </div>
        <div class="px-4 pb-4 min-w-full pr-20">
            <div class="flex justify-between items-center">
                <h1 class="pt-2 text-lg">{{ education.name }}</h1>
                <div class="pt-2 flex">
                    <button @click="openAddEditModal(education)" class="">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button @click="educationDeleteModal(education)" class="px-4">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

            </div>
            <div class="flex py-2 items-center">
                <i class="fas fa-calendar-alt text-gray-500 pr-2"></i>
                <p>{{ education.date }}</p>
                <i class="fas fa-map-marker-alt text-gray-500 px-2"></i>
                <p>{{ education.place }}</p>
            </div>
            <p class='text-gray-700'>
                {{education.description}}
            </p>
        </div>

    </div>
<!--    modals down here-->


    <div v-if="isAddEditModalOpen" class="modal">
        <div class="modal-content">
            <h3>{{ form.id ? "Edit Education" : "Add New Education" }}</h3>
            <input v-model="form.name" type="text" placeholder="Education name" class="input" />
            <textarea v-model="form.description" type="text" placeholder="Education description" class="input min-h-36" />
            <input v-model="form.date" type="text" placeholder="Education dates" class="input" />
            <input v-model="form.place" type="text" placeholder="Education place" class="input" />
            <input type="file" @change="e => (form.icon = e.target.files[0])" class="input mt-2" />
            <div class="flex gap-4 mt-4">
                <button @click="saveEducation" class="btn btn-success">Save</button>
                <button @click="isAddEditModalOpen = false" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>



    <!-- Modal usuwania -->
    <div v-if="isDeleteModalOpen" class="modal">
        <div class="modal-content">
            <h3>Are You sure you want to remove education: "{{ educationToDelete?.name }}"?</h3>
            <div class="flex gap-4 mt-4">
                <button @click="deleteEducation" class="btn btn-danger">Remove</button>
                <button @click="isDeleteModalOpen = false" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>


</div>
</template>

<style scoped>

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-content {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    max-width: 800px;
    width: 100%;
}
.input {
    width: 100%;
    padding: 0.5rem;
    margin-top: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.btn-primary {
    background: #007bff;
    color: white;
}
.btn-success {
    background: #28a745;
    color: white;
}
.btn-danger {
    background: #dc3545;
    color: white;
}
.btn-secondary {
    background: #6c757d;
    color: white;
}
</style>
