<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    sections: {
        type: Object,
        required: true,
        default: {}
    }
})

</script>

<template>
    <MainLayout>
        <div>
            <div class="flex items-center mb-5">
                <h1 class="text-xl mr-3">Разделы</h1>
                <Link :href="route('sections.create')" class="bg-white rounded-lg py-1 px-2 mr-3">+ Раздел</Link>
                <Link v-if="props.sections.length" :href="route('branches.create')" class="bg-white rounded-lg py-1 px-2">+ Ветка</Link>
            </div>
            <div v-if="props.sections">
                <div v-for="section in props.sections" class="mb-5">
                    <div>
                        <div class="text-xl mb-5 flex justify-between">
                            <h3>{{ section.title }}</h3>
                            <div class="flex justify-between w-14">
                                <Link :href="route('sections.edit', section.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </Link>
                                <Link :href="route('sections.destroy', section.id)" method="delete" as="button" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                        <div v-for="branch in section.branches" class="flex mb-2">
                            <Link :href="route('branches.show', branch.id)"
                                  class="block bg-white p-4 border border-gray-400 w-full">
                                <h3>{{ branch.title }}</h3>
                            </Link>
                            <Link :href="route('branches.edit', branch.id)" method="get" as="button" class="block bg-red-600 p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </Link>
                            <Link :href="route('branches.destroy', branch.id)" method="delete" as="button" type="button" class="block bg-sky-600 p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </Link>
                        </div>
                        <div v-if="!section.branches.length">
                            <p class="text-lg">У этого раздела еще нету веток!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
