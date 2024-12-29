<script setup>

import {Link} from "@inertiajs/vue3";

</script>

<template>
    <div>
        <div class="bg-white py-4 border-b border-gray-300">
            <div class="w-1/3 mx-auto py-2">
                <Link :href="route('sections.index')" class="mr-3">Форум</Link>
                <Link :href="route('users.personal')">Личный кабинет</Link>
            </div>
        </div>
        <div class="w-1/3 mx-auto py-4">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
