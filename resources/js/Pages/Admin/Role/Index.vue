<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    roles: {
        required: true,
        type: Object,
        default: {}
    }
});
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
                        <th class="py-3 px-6 text-left">Название</th>
                        <th class="py-3 px-6 text-left">Код</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-300 hover:bg-gray-100" v-for="role in props.roles">
                        <td class="py-3 px-6 text-left">{{ role.id }}</td>
                        <td class="py-3 px-6 text-left">{{ role.title }}</td>
                        <td class="py-3 px-6 text-left">{{ role.code }}</td>
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
