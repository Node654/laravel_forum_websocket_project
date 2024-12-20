<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    theme: {
        required: true,
        type: Object,
        default: {}
    }
})

const title = ref(props.theme.title);
const description = ref(props.theme.description);
const errors = ref({});

function update() {
    router.patch(route('themes.update', props.theme.id), {
        title: title.value,
        description: description.value,
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
            <h1 class="text-lg mb-2">Отредактировать тему</h1>
            <form @submit.prevent="update">
                <div class="mb-2">
                    <input :class="['w-1/3', errors.title ? 'border border-red-700' : '']" type="text" v-model="title" placeholder="Название темы">
                </div>
                <div v-if="errors.title" class="text-lg text-red-600 mb-2">
                    {{ errors.title }}
                </div>
                <div class="mb-2">
                    <textarea v-model="description" cols="30" rows="1"></textarea>
                </div>
                <div v-if="errors.description" class="text-lg text-red-600 mb-2">
                    {{ errors.description }}
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
