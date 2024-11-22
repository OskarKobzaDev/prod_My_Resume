<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { notify } from "@kyvg/vue3-notification";

const props = defineProps({
    languages: Array,
});

const form = useForm({
    id: null,
    name: "",
    icon: null,
});

const isAddEditModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const languageToDelete = ref(null);

const openAddEditModal = (language = null) => {
    if (language) {
        form.id = language.id;
        form.name = language.name;
        form.icon = null;
    } else {
        form.reset();
    }
    isAddEditModalOpen.value = true;
};

const openDeleteModal = (language) => {
    languageToDelete.value = language;
    isDeleteModalOpen.value = true;
};

const saveLanguage = () => {
    if (form.id) {
        form.patch(route("languages.patch", form.id), {
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                languageToDelete.value = null;
            },
            onError: (errors) => {
                console.error("Error while editing:", errors);
            },
            preserveScroll: true,
        });
    }
    else{
        form.post(route("languages.store"), {
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
};

const deleteLanguage = () => {
    if (languageToDelete.value) {
        form.delete(route("languages.destroy", languageToDelete.value.id), {
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                languageToDelete.value = null;
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
        <div class=" sm:px-10 md:px-20 mb-5 xl:px-72 xl:px-80 2xl:px-96">
            <button @click="openAddEditModal" class="btn btn-primary mb-4">Add New Language</button>

            <div class="flex flex-wrap gap-4">
                <div v-for="language in languages" :key="language.id" class="flex items-center gap-2">
                    <img :src="language.pngPath" alt="Language Icon" class="w-10 h-10 rounded-full" />
                    <span>{{ language.name }}</span>
                    <div>
                        <!-- Edycja -->
                        <button @click="openAddEditModal(language)">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <!-- Usuwanie -->
                        <button @click="openDeleteModal(language)" class="mx-4">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal dodawania/edycji -->
            <div v-if="isAddEditModalOpen" class="modal">
                <div class="modal-content">
                    <h3>{{ form.id ? "Edit Language" : "Add New Language" }}</h3>
                    <input v-model="form.name" type="text" placeholder="Language Name" class="input" />
                    <input type="file" @change="e => (form.icon = e.target.files[0])" class="input mt-2" />
                    <div class="flex gap-4 mt-4">
                        <button @click="saveLanguage" class="btn btn-success">Save</button>
                        <button @click="isAddEditModalOpen = false" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Modal usuwania -->
            <div v-if="isDeleteModalOpen" class="modal">
                <div class="modal-content">
                    <h3>Are You sure you want to remove language: "{{ languageToDelete?.name }}"?</h3>
                    <div class="flex gap-4 mt-4">
                        <button @click="deleteLanguage" class="btn btn-danger">Remove</button>
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
    max-width: 400px;
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
