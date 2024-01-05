<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue'
    import { Head, Link, router } from '@inertiajs/vue3';
    import { watch, ref, onMounted } from 'vue';
    import moment from'moment'
    import {inject} from 'vue'
const themeMode = inject('themeMode')
    // import Pagination from '@/Components/Pagination.vue';
    const props= defineProps({
        payroll:Object,
        employee:Object,
        filters:Object,
        flash:Object

    })

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }

    let search = ref(props.filters.search);
    watch(search, (value) => {
        router.get(
            "/tvshows",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    });
    onMounted(() => {
        // Set a timeout to hide the success flash message after 3 seconds
            const successFlashMessage = document.getElementById('flash-success-message');
                if (successFlashMessage) {
                    setTimeout(() => {
                    successFlashMessage.style.display = 'none';
                    }, 3000);
            }

            // Set a timeout to hide the error flash message after 3 seconds
            const errorFlashMessage = document.getElementById('flash-error-message');
                if (errorFlashMessage) {
                    setTimeout(() => {
                    errorFlashMessage.style.display = 'none';
                }, 3000);
            }
        });

</script>

<style scoped>

#flash-success-message {
    animation: fadeOut 7s ease-in-out forwards;
}

.progress-bar {
    height: 5px;
    width: 100%;
    background-color: #4CAF50; /* Green color */
    animation: progressBar 3s linear;
}
#flash-error-message {
    animation: fadeOut 7s ease-in-out forwards;
}

.success .progress-bar {

    animation: progressBar 5s linear;
}
.error .progress-bar {
    background-color: #FF5733; /* Red color */
    animation: progressBar 5s linear;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

@keyframes progressBar {
    0% {
        width: 100%;
    }
    100% {
        width: 0;
    }
}

</style>

<template>
    <Head title="Movies" />
    <SideBarLayout>

        <template #header >

            <div class="flex justify-between">
                <h2 class="font-semibold text-xl leading-tight mt-3">Recently Added</h2>
                <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Movies" v-model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex">
                    <Link class="button1 mb-2 py-2 px-3 bg-gray-500 shadow border-gray-500 border rounded mr-3 text-white" as="button" href="/movies/request">Request Movies</Link>
                    <Link class="button1 mb-2 py-2 px-3 bg-red-500 shadow border-red-500 border rounded mr-3 text-white" as="button" href="/movies/create">Add Movies</Link>
                </div>
            </div>
            <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-7 left-65 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.success }}
                <div class="progress-bar success"></div>
            </div>

            <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-7 left-65 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.error }}
                <div class="progress-bar error"></div>
            </div>
        </template>


    </SideBarLayout>
</template>
<style scoped>

.grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px 24px;
}
</style>
