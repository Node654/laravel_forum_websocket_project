<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";

const props = defineProps({
    branch: {
        type: Object,
        required: true,
        default: {},

    }
})

</script>

<template>

    <MainLayout>
        <div>
            <div>
                <h1 class="text-xl">{{ props.branch.title }}</h1>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
