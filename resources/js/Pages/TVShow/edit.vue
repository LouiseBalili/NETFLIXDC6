<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';

    const props = defineProps({
        tvshow:Object
    })

    const form = useForm({
        title: props.tvshow.title,
        genres: props.tvshow.genres,
        release_date: props.tvshow.release_date,
        summary: props.tvshow.summary,
        tvshow_pic: props.tvshow.tvshow_pic,
        tvshow_pic_url: props.tvshow.tvshow_pic_url
    })

    const photoPreview = ref(null);
    const photoInput = ref(null);

    const selectNewPhoto = () => {
    photoInput.value.click();
    };

    const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};


    const submit = async () => {
        form.put('/tvshows/' + props.tvshow.id)
    };
</script>

<template>
    <Head title="Edit TV Show" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl leading-tight mt-3">Edit TV Show</h2>
                <Link class="button1 mb-2 py-2 px-4 mr-5 bg-white shadow border rounded mr-3 text-gray-500 hover:text-gray-800" as="button" :href="'/tvshows/' + tvshow.id">Back</Link>
            </div>
        </template>


        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[850px] max-w-[95%] mx-auto bg-clip-border shadow-3xl shadow-shadow-500 p-3">
                    <h4 class="px-2 text-xl mb-3 font-bold text-navy-700">
                        TV Show Details
                    </h4>
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">

                    <div class="col-span-8 sm:col-span-8 text-center">
                        <input
                            ref="photoInput"
                            type="file"
                            @input="form.tvshow_pic = $event.target.files[0]"
                            class="hidden"
                            @change="updatePhotoPreview"
                        >

                        <InputLabel for="photo" value="TV Show Photo" />

                     <!-- Current TV Show Photo -->
                    <div v-show="!photoPreview" class="mt-2">
                        <div class="px-36 py-36 mb-3 flex justify-center items-center"
                            :style="'background-image: url(\'' + form.tvshow_pic_url + '\'); background-size: cover;'">
                        </div>
                    </div>


                        <!-- New TV Show Photo Preview -->
                        <div v-show="photoPreview" class="mt-2">
                            <span
                                class="block w-80 h-80 bg-cover mb-2 bg-no-repeat bg-center"
                                :style="'background-image: url(\'' + photoPreview + '\');'"
                            />
                        </div>

                        <SecondaryButton class="mt-2 inline-block px-28 py-2.5" type="button" @click.prevent="selectNewPhoto">
                            Select A Photo
                        </SecondaryButton>

                        <InputError :message="form.errors.tvshow_pic" class="mt-2" />
                    </div>

                            <div class="flex-1 pr-4 ms-8">
                                <div class="px-5 py-5">
                                    <label class="font-semibold text-sm block" for="title">Title</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-black dark:text-white" v-model="form.title"/>
                                    <div class="text-red-600" v-if="form.errors.title">{{ form.errors.title }}</div>

                                    <label class="font-semibold text-sm block" for="genres">Genres</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-black dark:text-white" v-model="form.genres" />
                                    <div class="text-red-600" v-if="form.errors.genres">{{ form.errors.genres }}</div>

                                    <label class="font-semibold text-sm block" for="release_date" >Release Date</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-black dark:text-white" v-model="form.release_date" />
                                    <div class="text-red-600" v-if="form.errors.release_date">{{ form.errors.release_date }}</div>

                                    <label class="font-semibold text-sm block" for="summary">Summary</label>
                                    <textarea class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-black dark:text-white" v-model="form.summary" />
                                    <div class="text-red-600" v-if="form.errors.summary">{{ form.errors.summary }}</div>

                                    <button class="px-4 py-2 mt-2 bg-red-500 w-full rounded border border-red-500 shadow text-white">
                                        Save Changes
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
