<script setup>
import SkillLabel from "@/Pages/Shared/SkillLabel.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import {notify} from "@kyvg/vue3-notification";

// Props
const props = defineProps({
    skills: Array,
});

// Form do dodawania/edycji
const form = useForm({
    id: null,
    name: "",
    colorHex: "#000000",
});

// Obsługa modali
const isAddEditModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const skillToDelete = ref(null);

// Funkcja otwierająca modal dodawania/edycji
const openAddEditModal = (skill = null) => {
    if (skill) {
        form.id = skill.id;
        form.name = skill.name;
        form.colorHex = skill.colorHex;
    } else {
        form.id = null;
        form.name = "";
        form.colorHex = "#000000";
    }
    isAddEditModalOpen.value = true;
};

// Funkcja otwierająca modal usuwania
const openDeleteModal = (skill) => {
    skillToDelete.value = skill;
    isDeleteModalOpen.value = true;
};

// Funkcje zapisania i usuwania
const saveSkill = () => {
    if (form.id) {
        form.patch(route('skills.patch', form.id), {
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
    } else {
        // Dodanie nowej umiejętności
        form.post('/skills', {
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
    }
    isAddEditModalOpen.value = false;
};

const deleteSkill = () => {
    if (skillToDelete.value) {
        form.delete(route('skills.destroy', skillToDelete.value.id), {
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                skillToDelete.value = null;
            },
            onError: (errors) => {
                console.error("Błąd podczas usuwania:", errors);
            },
        });
    }
};
</script>

<template>
    <div class="sm:px-10 md:px-20 mb-5 xl:px-72 2xl:px-96">
        <!-- Przycisk otwierający modal dodawania nowej umiejętności -->
        <button @click="openAddEditModal" class="btn btn-primary mb-4">Add New Skill</button>

        <div class="flex flex-wrap gap-4">
            <div v-for="skill in skills" :key="skill.id" class="flex items-center gap-2 rounded justify-between min-h-20 min-w-60 border border-black">
                <SkillLabel :skill="skill" class="ml-0 mb-0 min-h-full grow max-w-40 font-bold " />
                <!-- Ikona edycji -->
                <div>
                    <button @click="openAddEditModal(skill)" class="">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <!-- Ikona usuwania -->
                    <button @click="openDeleteModal(skill)" class="mx-4">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal dodawania/edycji -->
        <div v-if="isAddEditModalOpen" class="modal">
            <div class="modal-content">
                <h3>{{ form.id ? "Edit Your Skill" : "Add New Skill" }}</h3>
                <input v-model="form.name" type="text" placeholder="Skill Name" class="input" />
                <input v-model="form.colorHex" type="color" class="color-picker w-full mt-2" />
                <div class="flex gap-4 mt-4">
                    <button @click="saveSkill" class="btn btn-success">Save</button>
                    <button @click="isAddEditModalOpen = false" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Modal usuwania -->
        <div v-if="isDeleteModalOpen" class="modal">
            <div class="modal-content">
                <h3>Are You sure you want to remove skill: "{{ skillToDelete?.name }}"?</h3>
                <div class="flex gap-4 mt-4">
                    <button @click="deleteSkill" class="btn btn-danger">Remove</button>
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
