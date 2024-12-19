<script setup>

import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import {notify} from "@kyvg/vue3-notification";

defineProps({
    projects: Array,
})

const form = useForm({
    id: null,
    name: "",
    descriptionShort:"",
    descriptionLong:"",
    pngPath: "",
    pathGitHub: "",
    pathUrl: "",
    icon: null,
});

const isAddEditModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const projectToDelete = ref(null);
const originalData = ref(null);

const openAddEditModal = (project = null) => {
    if (project) {
        form.id = project.id;
        form.name = project.name;
        form.descriptionShort = project.descriptionShort;
        form.descriptionLong = project.descriptionLong;
        form.pathGitHub = project.pathGitHub;
        form.pathUrl = project.pathUrl;
        form.icon = null;

        originalData.value = {...project};
    } else {
        form.reset();
        originalData.value = { };
    }
    isAddEditModalOpen.value = true;
};

const saveProject = () => {
    const formData = new FormData();
    formData.append('id', form.id || '');
    formData.append('name', form.name);
    formData.append('descriptionShort', form.descriptionShort);
    formData.append('descriptionLong', form.descriptionLong);
    formData.append('pathGitHub', form.pathGitHub);
    formData.append('pathUrl', form.pathUrl);
    if (form.icon) {
        formData.append('icon', form.icon);
    }
    if (form.id) {
        form.post(route("projects.update", form.id), formData,{
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onSuccess: () => {
                isAddEditModalOpen.value = false;
                projectToDelete.value = null;
            },
            onError: (errors) => {
                console.error("Error while editing:", errors);
            },
            preserveScroll: true,
            preserveState: true,
        });
    }
    else{
        form.post(route("projects.store"), formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
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
            preserveState: true,
        });
    }
}

const projectDeleteModal = (project) => {
    projectToDelete.value = project;
    isDeleteModalOpen.value = true;
};
const deleteProject = () => {
    if (projectToDelete.value) {
        form.delete(route("projects.destroy", projectToDelete.value.id), {
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                projectToDelete.value = null;
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
        <button @click="openAddEditModal" class="btn btn-primary mb-4">Add New Project</button>

        <div v-for="project in projects" class="bg-slate-200 hover:bg-slate-400/50 text-gray-600 flex flex-col rounded-2xl transition-colors duration-500">

            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">{{project.name}}</h1>
                <p class="p-2">
                    {{project.descriptionShort}}
                </p>
                <div>
                    <button @click="openAddEditModal(project)" class="">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button @click="projectDeleteModal(project)" class="px-4">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="">
                <img :src="project.pngPath" class="object-fill">
            </div>
        </div>


        <div v-if="isAddEditModalOpen" class="modal">
            <div class="modal-content">
                <h3>{{ form.id ? "Edit Project" : "Add New Project" }}</h3>
                <input v-model="form.name" type="text" placeholder="Project name" class="input" />
                <input v-model="form.descriptionShort" type="text" placeholder="Project short description" class="input min-h-36" />
                <textarea v-model="form.descriptionLong" type="text" placeholder="Project long description" class="input min-h-36" />
                <input v-model="form.pathGitHub" type="text" placeholder="Project repo link" class="input" />
                <input v-model="form.pathUrl" type="text" placeholder="Project demo link" class="input" />
                <input type="file" @change="e => (form.icon = e.target.files[0])" class="input mt-2" />
                <div class="flex gap-4 mt-4">
                    <button @click="saveProject" class="btn btn-success">Save</button>
                    <button @click="isAddEditModalOpen = false" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>



        <!-- Modal usuwania -->
        <div v-if="isDeleteModalOpen" class="modal">
            <div class="modal-content">
                <h3>Are You sure you want to remove project: "{{ projectToDelete?.name }}"?</h3>
                <div class="flex gap-4 mt-4">
                    <button @click="deleteProject" class="btn btn-danger">Remove</button>
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
