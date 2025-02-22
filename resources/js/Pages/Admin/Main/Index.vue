<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    stats: {
        required: true,
        default: {},
        type: Object
    }
})

</script>

<template>

    <AdminLayout>

        <div>
            <div class="mb-3">
                <h3 class="text-lg">Статистика</h3>
            </div>
            <div>
                <div v-if="props.stats" class="flex flex-col sm:flex-row justify-between text-sm text-center">
                    <div v-for="stat in props.stats" class="mb-2 sm:mb-0">
                        <h3>{{ stat.title }}</h3>
                        <p>{{ stat.count }}</p>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>

</template>

<style scoped>

</style>
