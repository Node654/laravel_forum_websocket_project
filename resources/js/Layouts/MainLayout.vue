<script setup>

import {Link, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import axios from "axios";

const isNotification = ref(false);

function openNotification() {
    isNotification.value = !isNotification.value;
    const ids = usePage().props.auth.notifications.map(notification => notification.id)
    axios.patch(route('notifications.update'), {ids: ids})
        .then(res => {
            usePage().props.auth.notification_count = res.data.count;
            usePage().props.auth.notifications = res.data.notifications;
        })
}

</script>

<template>
    <div>
        <div class="bg-white py-4 border-b border-gray-300">
            <div class="w-1/2 mx-auto py-2 flex justify-between items-center">
                <div>
                    <Link :href="route('sections.index')" class="mr-3">Форум</Link>
                    <Link :href="route('users.personal')" class="mr-3">Личный кабинет</Link>
                    <Link :href="route('admins.index')">Админ панель</Link>
                </div>
                <div class="w-1/5 left-auto">
                    <div class="relative">
                        <div>
                            <div @click.prevent="openNotification"
                                 :class="[usePage().props.auth.notifications.length ? 'stroke-white fill-red-500' : 'stroke-black fill-white', 'ml-auto flex w-1/4 cursor-pointer']"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                                     class="size-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                                </svg>
                                <span>{{ usePage().props.auth.notification_count }}</span>
                            </div>
                        </div>
                        <div class="absolute text-left" v-if="usePage().props.auth.notifications.length && isNotification">
                            <div class="border border-gray-400 p-2 w-full bg-white"
                                 v-for="notification in usePage().props.auth.notifications">
                                <p>{{ notification.title }}</p>
                                <Link class="text-blue-500" :href="notification.url">Перейти</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2 mx-auto py-4">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
