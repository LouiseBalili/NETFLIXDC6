<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const form = useForm({
        title: null,
        year_released: null,
    })

    const props = defineProps({
        tvshowrequests:Object
    })

    const submit = async () => {
        form.post('/tvshows/request');
    };
</script>

<template>
    <Head title="Request TV Show" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl leading-tight mt-3">Request TV Show</h2>
                <Link class="button1 mb-2 py-2 px-4 mr-5 bg-gray-500 shadow border-gray-500 border rounded mr-3 text-white" as="button" href="/tvshows">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-clip-border shadow-3xl shadow-shadow-500 p-3">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl mb-3 font-bold text-navy-700 text-center">
                                    TV Show Details
                                </h4>
                                <div class="px-5 py-5">
                                    <label class="font-semibold text-sm block" for="title">Title</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-black dark:text-white" v-model="form.title"/>
                                    <div class="text-red-600" v-if="form.errors.title">{{ form.errors.title }}</div>

                                    <label class="font-semibold text-sm block" for="year_released">Year Released</label>
                                    <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-black dark:text-white" v-model="form.year_released" />
                                    <div class="text-red-600" v-if="form.errors.year_released">{{ form.errors.year_released }}</div>

                                    <button class="px-4 py-2 mt-2 bg-red-500 w-full rounded border border-red-500 shadow text-white">
                                        Send Request ->
                                    </button>
                                  </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>
