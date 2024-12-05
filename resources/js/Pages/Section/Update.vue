<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    section: {
        type: Object,
        required: true,
        default: {}
    }
})

const errors = ref({});
const title = ref(props.section.title);

function update() {
    router.patch(route('sections.update', props.section.id), {
        'title': title.value
    }, {
        onError: (rej) => {
            errors.value = rej;
            console.log(rej);
        }
    })
}

</script>

<template>
    <MainLayout>
        <div>
            <h1 class="text-lg mb-2">Отредактировать раздел</h1>
            <form @submit.prevent="update">
                <div class="mb-2">
                    <input :class="['w-1/3', errors.title ? 'border border-red-700' : '']" type="text" v-model="title" placeholder="Заголовок">
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
