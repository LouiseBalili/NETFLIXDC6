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

    <div class="rounded-lg p-4 border-2 border-gray-400 bg-white shadow flex hover:bg-blue-100">
        <div class="cursor-pointer flex flex-1" @click="open(tvshow)">
            <img :src="tvshow.tvshow_pic_url" alt="Profile Picture" class="aspect-square w-40 object-cover mb-4">
            <div class="ml-4 flex-1">
                <h3 class="font-bold">
                    TV Show Details
                </h3>
                <hr>
                <div class="text-2xl">{{ tvshow.title }}</div>
                <div class="italic">{{ tvshow.genres }}</div>
            </div>
        </div>
    </div>

</template>


