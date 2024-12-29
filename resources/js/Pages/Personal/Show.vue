<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import {useTemplateRef} from "vue";
import axios from "axios";

const props = defineProps({
    user: {
        type: Object,
        required: true,
        default: {},
    }
})


const avatar = useTemplateRef('avatar');

function updateAvatar() {
    const formData = new FormData();
    formData.append('_method', 'patch');
    formData.append('avatar', avatar.value.files[0]);
    axios.post(route('users.personal'), formData).then(res => {
        props.user.avatar = res.data.avatar;
    })
}

</script>

<template>

    <MainLayout>
        <div>
            <div class="mb-4 flex">
                <h1 class="text-xl mr-4">Личный кабинет</h1>
            </div>
            <div class="bg-white border border-gray-400 p-4">
                <div class="mb-4">
                    <p class="text-lg">Приветствую, {{ props.user.name }}</p>
                </div>
                <div >
                    <p class="text-lg mb-2">Сменить аватар</p>
                    <button @click.prevent="avatar.click()" type="button" :class="['block w-24 h-24 ', props.user.avatar ? '' : 'rounded-full bg-gray-500']">
                        <img v-if="props.user.avatar" :src="props.user.avatar" :alt="props.user.name">
                    </button>
                    <div hidden>
                        <input @change.prevent="updateAvatar" ref="avatar" type="file">
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
