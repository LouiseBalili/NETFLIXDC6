<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';
    import moment from 'moment';
    import Modal from '@/Components/Modal.vue';
    import { ref } from 'vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';

    const props = defineProps({
    movie: Object
    })

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    let showConfirm = ref(false)
    let deleteForm = useForm({});

    function remove() {
        showConfirm.value = true;
    }

    function deleteMovie(movie){
        deleteForm.delete('/movies/' + movie.id)
        showConfirm.value = false;
    }

    function closeModal(){
        showConfirm.value = false;
    }
</script>

<template>
    <Head title="View Movie" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl leading-tight mt-3">View Movie</h2>
                <Link class="button1 mb-2 py-2 px-4 mr-5 bg-white shadow border rounded mr-3 text-gray-500 hover:text-gray-800" as="button" href="/movies">Back</Link>
            </div>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">
                        <img :src="movie.movie_pic_url" alt="Movie Picture" class="aspect-square w-60 h-80 mb-4">
                        <div class="flex-1 ml-4">
                            <div>
                                <h3 class="text-2xl flex-1">{{ movie.title }}</h3>
                            </div>
                            <hr>
                            <div class="mt-4">{{ movie.genres }}</div>
                            <div class="py-4">{{formattedDate( movie.release_date )}}</div>
                            <div class="p-4 border rounded">
                                {{ movie.summary }}
                            </div>
                            <div class="flex justify-end mt-16 mr-5" v-if="$page.props.auth.permissions.includes('manage_all')">
                                <Link class="button1 mb-2 py-2 px-3 bg-gray-500 shadow border-gray-500 border rounded mr-3 text-white" :href="'/movies/edit/' + movie.id" as="button">Edit</Link>
                                <!-- <Link class="button1 mb-2 py-2 px-3 bg-red-500 shadow border-red-500 border rounded text-white" :href="'/movies/' + movie.id" method="delete" as="button">Delete</Link> -->
                                <a href="#" @click="remove(movie)" class="button1 mb-2 py-2 px-3 bg-red-500 shadow border-red-500 border rounded text-white" title="Delete Movie">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="showConfirm" @close="closeModal">
            <div class="p-4 sm:p-10 text-center overflow-y-auto">
                <span class="mb-4 inline-flex justify-center items-center w-[62px] h-[62px] rounded-full border-4 border-red-50 bg-red-100 text-red-500">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>
                </span>

                <h3 class="mb-2 text-2xl font-bold text-gray-800">
                    Delete Movie
                </h3>
                <p class="text-gray-500">
                    Are you sure you want like to delete this Movie?
                </p>

                <div class="mt-6 flex justify-center gap-x-4">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                    <DangerButton @click="() => deleteMovie(movie)">Delete</DangerButton>
                </div>
            </div>
        </Modal>

    </SideBarLayout>
</template>
