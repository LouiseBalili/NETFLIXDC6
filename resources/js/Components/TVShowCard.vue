<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    tvshow: Object
})

function open(tvshow) {
    router.visit('/tvshows/' + tvshow.id)
}

</script>

<template>

    <div class="rounded-lg p-4 border-2 border-gray-400 bg-gray-300 shadow flex hover:bg-gray-400">
        <div class="cursor-pointer flex flex-1" @click="open(tvshow)">
            <img :src="tvshow.tvshow_pic_url" alt="TV Show Picture" class="aspect-square w-40 object-cover mb-4">
            <div class="ml-4 flex-1">
                <h3 class="font-bold text-black">
                    TV Show Details
                </h3>
                <hr>
                <div class="text-2xl text-black">{{ tvshow.title }}</div>
                <div class="italic text-black">{{ tvshow.genres }}</div>
            </div>
        </div>
    </div>

</template>
