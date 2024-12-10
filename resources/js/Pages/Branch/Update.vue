<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    sections: {
        required: true,
        type: Object,
        default: {}
    },
    branch: {
        required: true,
        type: Object,
        default: {}
    }
})

const title = ref(props.branch.title);
const sectionId = ref(props.branch.section_id);
const parentId = ref(null);
const branches = ref({});
const errors = ref({});

function getBranches() {
    parentId.value = null;
    axios.get(route('section-branches.index-except', {'section': sectionId.value, 'branch': props.branch.id}))
        .then(res => {
                branches.value = res.data;
            }
        )
}

function update() {
    router.patch(route('branches.update', {branch: props.branch.id}), {
        'section_id': sectionId.value,
        'title': title.value,
        'parent_id': parentId.value
    }, {
        onError: (rej) => {
            errors.value = rej;
        }
    })
}

onMounted(() => {
    getBranches();
    parentId.value = props.branch.parent_id;
});

</script>

<template>
    <MainLayout>
        <div>
            <h1 class="text-lg mb-2">Отредактировать ветку</h1>
            <form @submit.prevent="update">
                <div class="mb-2" v-if="props.sections.length > 0">
                    <select @change.prevent="getBranches" :class="['w-1/3', errors.section_id ? 'border border-red-700' : '']" v-model="sectionId">
                        <option :value="null" selected disabled>Выберите раздел</option>
                        <option v-for="section in props.sections" :value="section.id">{{ section.title }}</option>
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
                    <button class="bg-sky-500 text-white p-2 w-1/3" type="submit">Отредактировать</button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
