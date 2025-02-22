<script setup>
    import {Link} from "@inertiajs/vue3";
</script>

<template>

    <div>
        <div class="bg-white py-4 border-b border-gray-300">
            <div class="w-1/2 mx-auto py-2">
                <Link :href="route('sections.index')" class="mr-3">Форум</Link>
                <Link :href="route('users.personal')" class="mr-3">Личный кабинет</Link>
                <Link :href="route('admins.index')">Админ панель</Link>
            </div>
        </div>
        <div class="flex items-start w-1/2 mx-auto py-4">
            <div class="w-1/4 bg-white border border-gray-400 mr-4">
                <h3 class="text-lg p-4">Меню</h3>
                <div>
                    <div class="w-full p-4 border-t border-b border-gray-400">
                        <Link :href="route('admins.index')" class="text-sm">Статистика</Link>
                    </div>
                    <div class="w-full p-4 border-b border-gray-400">
                        <Link :href="route('admins.index-complaints')" class="text-sm">Жалобы</Link>
                    </div>
                    <div class="w-full p-4 border-b border-gray-400">
                        <Link :href="route('admins.roles.index')" class="text-sm">Роли</Link>
                    </div>
                    <div class="w-full p-4">
                        <Link :href="route('admins.index-users')" class="text-sm">Пользователи</Link>
                    </div>
                </div>
            </div>
            <div class="w-3/4 bg-white border border-gray-400 p-4">
                <slot/>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
