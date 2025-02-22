<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

const props = defineProps({
    complaints: {
        required: true,
        type: Object,
        default: {}
    }
})

function handleAction(complaint) {
    axios.patch(route('admins.index-complaints.update', complaint.id)).then(res => {
        complaint.isSolved = res.data.isSolved;
    })
}

</script>

<template>

    <AdminLayout>

        <div>
            <div class="mb-3">
                <h3 class="text-lg">Жалобы</h3>
            </div>
            <div>
                <div>
                    <table class="w-full bg-white border border-gray-200 text-center">
                        <thead>
                            <tr class="bg-gray-300 text-gray-600 uppercase">
                                <th class="py-2 px-2">ID</th>
                                <th class="py-2 px-2">Текст</th>
                                <th class="py-2 px-2">Пользователь</th>
                                <th class="py-2 px-2">Ссылка(Сообщение)</th>
                                <th class="py-2 px-2">Статус</th>
                                <th class="py-2 px-2">Действия</th>
                            </tr>
                        </thead>
                        <tbody v-if="props.complaints" class="text-gray-600 font-light">
                            <tr v-for="complaint in props.complaints" class="hover:bg-gray-200">
                                <td class="py-2 px-2">{{ complaint.id }}</td>
                                <td class="py-2 px-2">{{ complaint.body }}</td>
                                <td class="py-2 px-2">{{ complaint.user.name }}</td>
                                <td class="py-2 px-2">
                                    <Link :href="route('themes.show', complaint.theme_id) + `#${complaint.message_id}`" class="text-blue-500">Ссылка</Link>
                                </td>
                                <td class="py-2 px-2 whitespace-nowrap">{{ complaint.isSolved ? 'Решено' : 'Не решено' }}</td>
                                <td class="py-2 px-2 text-center">
                                    <button @click.prevent="handleAction(complaint)" class="text-red-500 hover:text-red-700">
                                        <svg :class="[complaint.isSolved ? 'stroke-green-700' : 'stroke-red-700', 'w-6 h-6']" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </AdminLayout>

</template>

<style scoped>

</style>
