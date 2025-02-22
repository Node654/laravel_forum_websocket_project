<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";

const title = ref('');
const sectionId = ref(null);
const parentId = ref(null);
const branches = ref({});
const errors = ref({});

const props = defineProps({
    sections: {
        required: true,
        type: Object
    },
})

function store() {
    router.post(route('branches.store'), {
        'section_id': sectionId.value,
        'title': title.value,
        'parent_id': parentId.value
    }, {
        onError: (rej) => {
            errors.value = rej;
        }
    })
}

function getBranches() {
    axios.get(route('section-branches.index', {'section': sectionId.value}))
        .then(res => {
            parentId.value = null;
            branches.value = res.data;
        }
    )
}

</script>

<template>
    <MainLayout>
        <div>
            <h1 class="text-lg mb-2">Добавить ветку</h1>
            <form @submit.prevent="store">
                <div class="mb-2" v-if="props.sections.length > 0">
                    <select @change.prevent="getBranches" :class="['w-1/3', errors.section_id ? 'border border-red-700' : '']" v-model="sectionId">
                        <option :value="null" selected disabled>Выберите раздел</option>
                        <template v-for="section in props.sections">
                            <template v-if="usePage().props.auth.roles.some(code => {
                                return [
                                    `Editor`,
                                    `Editor.${section.id}`,
                                ].includes(code);
                            })">
                                <option :value="section.id">{{
                                    section.title
                                  }}
                                </option>
                            </template>
                        </template>
                    </select>
                    <div v-if="errors.section_id" class="text-lg text-red-600 mb-2">
                        {{ errors.section_id }}
                    </div>
                </div>
                <div class="mb-2" v-if="branches.length > 0">
                    <select class="w-1/3" v-model="parentId">
                        <option :value="null" selected disabled>Выберите ветку</option>
                        <option v-for="branch in branches" :value="branch.id">{{ branch.title }}</option>
                    </select>
                </div>
                <div class="mb-2">
                    <input :class="['w-1/3', errors.title ? 'border border-red-700' : '']" type="text" v-model="title" placeholder="Новая ветка">
                </div>
                <div v-if="errors.title" class="text-lg text-red-600 mb-2">
                    {{ errors.title }}
                </div>
                <div>
                    <button class="bg-sky-500 text-white p-2 w-1/3" type="submit">Добавить</button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
