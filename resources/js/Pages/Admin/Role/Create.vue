<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {ref} from "vue";
import axios from "axios";
import {router} from "@inertiajs/vue3";

const title = ref('');
const sectionId = ref(null);
const branchId = ref(null);
const branches = ref({});

const props = defineProps({
    sections: {
        required: true,
        type: Object
    },
})

function store() {
    router.post(route('admins.roles.store'), {
        title: title.value,
        section_id: sectionId.value,
        branch_id: branchId.value,
    })
}

function getBranches() {
    axios.get(route('section-branches.index', {section: sectionId.value})).then(res => {
        branches.value = res.data;
    })
}

</script>

<template>

    <AdminLayout>

        <div class="border-b border-gray-400 pb-5">
            <h3 class="text-lg">Добавить роль</h3>
        </div>
        <div>
            <h1 class="text-lg mb-2">Добавить ветку</h1>
            <form @submit.prevent="store">
                <div class="mb-2" v-if="props.sections.length > 0">
                    <select class="w-1/3" @change.prevent="getBranches" v-model="sectionId">
                        <option :value="null" selected disabled>Выберите раздел</option>
                        <option v-for="section in props.sections" :value="section.id">{{ section.title }}</option>
                    </select>
                </div>
                <div class="mb-2" v-if="branches.length > 0">
                    <select class="w-1/3" v-model="branchId">
                        <option :value="null" selected disabled>Выберите ветку</option>
                        <option v-for="branch in branches" :value="branch.id">{{ branch.title }}</option>
                    </select>
                </div>
                <div class="mb-2">
                    <input class="w-1/3" type="text" v-model="title" placeholder="Роль">
                </div>
                <div>
                    <button class="bg-sky-500 text-white p-2 w-1/3" type="submit">Добавить</button>
                </div>
            </form>
        </div>

    </AdminLayout>

</template>

<style scoped>

</style>
