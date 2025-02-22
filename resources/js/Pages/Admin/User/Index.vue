<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";
import {ref} from "vue";

const props = defineProps({
    users: {
        required: true,
        type: Object,
        default: {}
    },
    roles: {
        required: true,
        type: Object,
        default: {}
    }
})

function toggleRole(user, roleId) {
    axios.post(route('admins.users-roles', user.id), {role_id: roleId})
        .then(res => {
            user.roles = res.data.roles;
        })
}

function roleChange(user) {
    user.isChangeRole = !user.isChangeRole;
    props.users.filter(filteredUsers => {
        return filteredUsers.id !== user.id;
    }).map(filteredUser => {
        filteredUser.isChangeRole = false;
    })
}

</script>

<template>

    <AdminLayout>

        <div class="mb-2 flex items-center border-b border-gray-400 pb-5">
            <h3 class="text-lg mr-4">Роли</h3>
            <div class="border border-gray-400 rounded-lg">
                <Link :href="route('admins.roles.create')" class="block py-1 p-2">+ Роль</Link>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Имя</th>
                        <th class="py-3 px-6 text-left">Роли</th>
                        <th class="py-3 px-6 text-left">Изменить роль</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light" v-if="props.users">
                    <tr class="border-b border-gray-300 hover:bg-gray-100" v-for="user in props.users">
                        <td class="py-3 px-6 text-left">{{ user.id }}</td>
                        <td class="py-3 px-6 text-left">{{ user.name }}</td>
                        <td class="py-3 px-6 text-left">
                            <div>
                                <p v-for="role in user.roles">{{ role.code }}</p>
                                <p class="text-lg" v-if="!user.roles">Ролей нет</p>
                            </div>
                        </td>
                        <td class="py-3 px-6 p-4">
                            <button @click.prevent="roleChange(user)" type="button" class="mb-2 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                                {{ user.isChangeRole ? 'Закрыть' : 'Выбрать' }}
                            </button>
                            <div v-if="user.isChangeRole">
                                <div v-for="role in props.roles">
                                    <input @change.prevent="toggleRole(user, role.id)" :checked="user.roles.some(userRole => userRole.id === role.id)" class="cursor-pointer mr-2" type="checkbox" :id="`${user.id} ${role.id}`" :value="role.id">
                                    <label class="cursor-pointer" :for="`${user.id} ${role.id}`">{{ role.code }}</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </AdminLayout>

</template>

<style scoped>
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f3f4f6;
}

tr:hover {
    background-color: #f1f5f9;
}

@media (max-width: 768px) {
    th, td {
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    tr {
        margin-bottom: 15px;
        display: block;
        border: 1px solid #e5e7eb;
    }
}
</style>
