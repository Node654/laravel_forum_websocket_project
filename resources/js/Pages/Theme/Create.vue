<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    branch: {
        required: true,
        default: {},
        type: Object
    }
})

const title = ref('');
const description = ref('');
const errors = ref({});

function store() {
    router.post(route('themes.store'), {
        'title': title.value,
        'description': description.value,
        'branch_id': props.branch.id,
    }, {
        onError: (rej) => {
            errors.value = rej;

        }
    })
}

</script>

<template>
    <MainLayout>
        <div>
            <h1 class="text-lg mb-2">Добавить тему</h1>
            <form @submit.prevent="store">
                <div class="mb-2">
                    <input :class="['w-1/3', errors.title ? 'border border-red-700' : '']" type="text" v-model="title" placeholder="Заголовок">
                </div>
                <div v-if="errors.title" class="text-lg text-red-600 mb-2">
                    {{ errors.title }}
                </div>
                <div class="mb-2">
                    <textarea :class="['w-1/2', errors.description ? 'border border-red-700' : '']" type="text" v-model="description" placeholder="Описание" rows="1">
                    </textarea>
                </div>
                <div v-if="errors.description" class="text-lg text-red-600 mb-2">
                    {{ errors.description }}
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
