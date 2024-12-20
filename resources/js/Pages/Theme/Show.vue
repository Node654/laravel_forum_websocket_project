<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {useTemplateRef} from "vue";

const props = defineProps({
    theme: {
        type: Object,
        required: true,
        default: {},
    }
})

const content = useTemplateRef('body');

function storeMessage() {
    axios.post(route('messages.store'), {
        body: content.value.innerHTML,
        theme_id: props.theme.id
    }).then(res => {
        console.log(res);
    })
}

</script>

<template>

    <MainLayout>
        <div>
            <div class="mb-5 flex">
                <h1 class="text-xl mr-4">{{ props.theme.title }}</h1>
            </div>
            <div class="bg-white p-4">
                <h3 class="text-xl mb-2">Добавить сообщение</h3>
                <div ref="body" contenteditable="true" class="border border-gray-500 p-2 mb-3"></div>
                <button @click.prevent="storeMessage" class="px-9 py-2 bg-sky-600 text-white">Опубликовать</button>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
