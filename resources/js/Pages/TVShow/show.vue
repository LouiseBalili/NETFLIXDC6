<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';
    import moment from 'moment';

    const props = defineProps({
    tvshow: Object
    })

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }
</script>

<template>
    <Head title="View TV Show" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl leading-tight mt-3">View TV Show</h2>
                <Link class="button1 mb-2 py-2 px-4 mr-5 bg-white shadow border rounded mr-3 text-gray-500 hover:text-gray-800" as="button" href="/tvshows">Back</Link>
            </div>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">
                        <img :src="tvshow.tvshow_pic_url" alt="TV Show Picture" class="aspect-square w-60 h-80 mb-4">
                        <div class="flex-1 ml-4">
                            <div>
                                <h3 class="text-2xl flex-1">{{ tvshow.title }}</h3>
                            </div>
                            <hr>
                            <div class="mt-4">{{ tvshow.genres }}</div>
                            <div class="py-4">{{formattedDate( tvshow.release_date )}}</div>
                            <div class="p-4 border rounded">
                                {{ tvshow.summary }}
                            </div>
                            <div class="flex justify-end mt-16 mr-5">
                                <Link class="button1 mb-2 py-2 px-3 bg-gray-500 shadow border-gray-500 border rounded mr-3 text-white" :href="'/tvshows/edit/' + tvshow.id" as="button">Edit</Link>
                                <Link class="button1 mb-2 py-2 px-3 bg-red-500 shadow border-red-500 border rounded text-white" :href="'/tvshows/' + tvshow.id" method="delete" as="button">Delete</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>
