<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {ref, useTemplateRef} from "vue";
import axios from "axios";

const props = defineProps({
    theme: {
        type: Object,
        required: true,
        default: {},
    }
})

const body = useTemplateRef('body');
const image = useTemplateRef('image');

function storeMessage() {
    axios.post(route('messages.store'), {
        body: body.value.innerHTML,
        theme_id: props.theme.id
    }).then(res => {
        body.value.innerHTML = '';
        props.theme.messages.push(res.data);
    })
}

function toggleLike(message) {
    axios.post(route('messages.like', message.id))
        .then(res => {
            message.isLiked ? message.totalLikes-- : message.totalLikes++;
            message.isLiked = !message.isLiked;
        })
}

function quote(messageBody) {
    const userText = body.value.innerHTML;
    if (document.getSelection().toString())
    {
        messageBody = document.getSelection().toString();
    }

    body.value.innerHTML = userText + '<br>' + '<blockquote>' + messageBody + '</blockquote>' + '<br>';
}

function answer(message) {
    const userText = body.value.innerHTML;
    const title = `<input type="text" class="w-full bg-gray-200 p-2" value="Ответ пользователю @${message.user.id} ${message.user.name} ${message.created_at} " disabled>`;
    body.value.innerHTML = userText + `${title}<blockquote>${message.body}</blockquote><br>`;
}
function openComplaint(message) {
    message.content = '';
    message.is_complaint = !message.is_complaint;
}

function storeComplaint(message) {
    axios.post(route('messages.complaints-store', message.id), {
        theme_id: props.theme.id,
        body: message.content
    }).then(res => {
        console.log(res);
        if (!res.data.isNotSolvedComplaint) {
            message.isNotStoreComplaintMyselfMessage = true;
            message.content = '';
            setTimeout(function () {
                message.isNotStoreComplaintMyselfMessage = false;
            }, 5000);
        } else {
            message.content = '';
            message.isNotSolvedComplaint = res.data.isNotSolvedComplaint;
        }
    })
}

function storeImage() {
    const formData = new FormData();
    formData.append('image', image.value.files[0]);
    axios.post(route('images.store'), formData).then(res => {
        const image = `<span hidden>img=${res.data.id}</span> <img src="${res.data.url}" alt="Test">`;
        const oldText = body.value.innerHTML;
        body.value.innerHTML = `${oldText}<br> ${image} <br>`;
    })
}

function strong() {
    if (window.getSelection().toString()) {
        const range = window.getSelection().getRangeAt(0);
        const strong = document.createElement('strong');
        range.surroundContents(strong);
    }
}

window.Echo.channel(`store_messages_${props.theme.id}`)
    .listen('.store_messages', res => {
        props.theme.messages.push(res.message);
    })

window.Echo.channel(`messages.likes.${props.theme.id}`)
    .listen('.messages.likes', res => {
        props.theme.messages.filter(message => {
            return message.id === res.message_id;
        }).map(message => {
            message.totalLikes = res.likesCount;
        })
    })

</script>

<template>

    <MainLayout>
        <div class="w-full">
            <div class="mb-5 flex">
                <h1 class="text-xl mr-4">{{ props.theme.title }}</h1>
            </div>
            <div v-for="message in props.theme.messages" :id="message.id" class="flex bg-white border border-gray-400">
                <div class="p-4 border-r border-gray-400 w-1/4">
                    <div class="bg-gray-400 rounded-full w-24 h-24 mx-auto mb-2 overflow-hidden">
                        <img :src="message.user.avatar" :alt="message.user.name" class="block rounded-full w-24 h-24">
                    </div>
                    <div class="text-center text-xl">
                        {{ message.user.name }}
                    </div>
                </div>
                <div class="p-4 w-full">
                    <div class="mb-2">
                        <p class="italic">{{ message.created_at }}</p>
                    </div>
                    <div v-if="message.isNotStoreComplaintMyselfMessage" class="bg-red-100 border border-red-500 p-2 mb-2">
                        <p>Вы не можете оставлять жалобу на свое сообщение!</p>
                    </div>
                    <div v-if="message.isNotSolvedComplaint" class="bg-red-100 border border-red-500 p-2 mb-2">
                        <p>Ваша жалоба в рассмотрении!</p>
                    </div>
                    <div class="mb-4">
                        <h3 v-html="message.body"></h3>
                    </div>
                    <div class="flex justify-end items-center">
                        <button @click.prevent="openComplaint(message)" type="button" class="mr-4 border border-red-700 bg-white p-2 text-red-800 rounded-full">Пожаловаться</button>
                        <button @click.prevent="quote(message.body)" type="button" class="mr-4 bg-sky-500 p-2 text-white rounded-full">Цитировать</button>
                        <button @click.prevent="answer(message)" type="button" class="mr-4 bg-indigo-500 p-2 text-white rounded-full">Ответить</button>
                        <span class="mr-4">{{ message.totalLikes }}</span>
                        <svg @click.prevent="toggleLike(message)" fill="none" :class="[message.isLiked ? 'fill-red-500' : 'fill-blue-500', 'cursor-pointer w-6 h-6']" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 487.57 487.57"><g><path d="M137.482,253.8c0.7-2,1.5-4.2,2.4-6.5l0,0l0,0c3.8-9.4,10.1-20.9,19.9-31.2c46-35.3,94.2-168,94.2-168s-7.5-48.1,15-48.1 s76,15,43.9,112.3c-32.1,97.4,0,82.4,0,82.4c7.4-1.7,14.2-3.1,20.7-4.2l0,0c0,0,92.7-20.8,126.9,10.5c27.4,25,6.1,58,6.1,58 s38.5,34.3-0.7,75.3c0,0,25.1,41.5-19,74.6c0,0,20.5,57.1-61.4,74.5c-24.1,5.1-54.4,4.9-83,2.7c-71.5,1.5-142.6-7.8-142.6-7.8 l-46-200.1C127.782,269.8,134.382,260.1,137.482,253.8z M4.182,281l-0.1,200h108.7c9.7,0,16-7.7,14-17.2l-34.8-165.6 c-2-9.5-11.5-17.2-21.2-17.2L4.182,281L4.182,281z"/></g></svg>
                    </div>
                    <div v-if="message.is_complaint" class="flex mt-4">
                        <input class="w-4/5 border-gray-300 rounded-full rounded-r-none" placeholder="Ваша жалоба" type="text" v-model="message.content">
                        <button @click.prevent="storeComplaint(message)" class="block p-3 bg-red-700 text-white rounded-lg rounded-l-none">Отправить</button>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 border border-gray-400">
                <h3 class="text-xl mb-2">Добавить сообщение</h3>
                <div class="flex w-full p-2 bg-gray-100">
                    <div class="mr-1">
                        <button @click.prevent="image.click()" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </button>
                        <input @change.prevent="storeImage" ref="image" type="file" hidden>
                    </div>
                    <div>
                        <button type="button" @click.prevent="strong()">
                            <strong>
                                B
                            </strong>
                        </button>
                    </div>
                </div>
                <div>
                    <div ref="body" contenteditable="true" class="border border-gray-500 p-2 mb-3"></div>
                    <button @click.prevent="storeMessage" class="px-9 py-2 bg-sky-600 text-white">Опубликовать</button>
                </div>
            </div>
        </div>
    </MainLayout>

</template>

<style>
    blockquote {
        font-style: italic; /* Курсив для текста цитаты */
        border-left: 4px solid #4CAF50; /* Зеленая линия слева */
        padding: 10px 20px; /* Отступы вокруг текста */
        margin: 0 0; /* Отступ сверху и снизу */
        background-color: #f9f9f9; /* Светлый фон */
        color: #555; /* Цвет текста */
        border-radius: 5px; /* Скругленные углы */
        quotes: "“" "”" "‘" "’"; /* Кавычки для цитаты */
    }

    blockquote:before {
        content: open-quote; /* Открывающие кавычки */
        font-size: 30px; /* Размер кавычек */
        line-height: 1; /* Высота строки для кавычек */
        margin-right: 10px; /* Отступ справа от кавычек */
        color: #4CAF50; /* Цвет кавычек */
    }

    blockquote:after {
        content: close-quote; /* Закрывающие кавычки */
        font-size: 30px; /* Размер кавычек */
        line-height: 1; /* Высота строки для кавычек */
        margin-left: 10px; /* Отступ слева от кавычек */
        color: #4CAF50; /* Цвет кавычек */
    }
</style>
