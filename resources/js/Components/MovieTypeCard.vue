<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    movie: Object
})

function open(movie) {
    router.visit('/movies/' + movie.id)
}
</script>

<template>

    <div class="rounded-lg p-4 border-2 border-gray-400 bg-gray-300 shadow flex hover:bg-gray-400">
        <div class="cursor-pointer flex flex-1" @click="open(movie)">
            <img :src="movie.movie_pic_url" alt="Movie Picture" class="aspect-square w-40 object-cover mb-4">
            <div class="ml-4 flex-1">
                <h3 class="font-bold text-black">
                    Movie Details
                </h3>
                <hr>
                <div class="text-2xl text-black">{{ movie.title }}</div>
                <div class="italic text-black">{{ movie.genres }}</div>
            </div>
        </div>
    </div>

</template>
