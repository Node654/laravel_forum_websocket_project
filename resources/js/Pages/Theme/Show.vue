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

const body = useTemplateRef('body');

function storeMessage() {
    axios.post(route('messages.store'), {
        body: body.value.innerHTML,
        theme_id: props.theme.id
    }).then(res => {
        body.value.innerHTML = '';
        props.theme.messages.push(res.data);
    })
}

</script>

<template>

    <MainLayout>
        <div class="w-full">
            <div class="mb-5 flex">
                <h1 class="text-xl mr-4">{{ props.theme.title }}</h1>
            </div>
            <div v-for="message in props.theme.messages" class="flex bg-white border border-gray-400">
                <div class="p-4 border-r border-gray-400 w-1/4">
                    <div class="bg-gray-400 rounded-full w-24 h-24 mx-auto mb-2">
                    </div>
                    <div class="text-center text-xl">
                        {{ message.user.name }}
                    </div>
                </div>
                <div class="p-4">
                    <div>
                        <p class="mb-2 italic">{{ message.created_at }}</p>
                    </div>
                    <div>
                        <h3 v-html="message.body"></h3>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 border border-gray-400">
                <h3 class="text-xl mb-2">Добавить сообщение</h3>
                <div ref="body" contenteditable="true" class="border border-gray-500 p-2 mb-3"></div>
                <button @click.prevent="storeMessage" class="px-9 py-2 bg-sky-600 text-white">Опубликовать</button>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
