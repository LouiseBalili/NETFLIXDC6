<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import moment from'moment'
import {inject} from 'vue'
const themeMode = inject('themeMode')

const props = defineProps({
    logEntries:Object
})
function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
</script>


<template>

    <Head title="Requests" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl  leading-tight">Request Logs</h2>
                <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                    {{ $page.props.flash.success }}
                    <div class="progress-bar success"></div>
                </div>

                <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                    {{ $page.props.flash.error }}
                    <div class="progress-bar error"></div>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="min-w-full mx-auto sm:px-6 lg:px-7">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg" :class="themeMode">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Entry
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Type
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                TimeStamp
                            </th>
                            </tr>
                        </thead>
                        <tbody class=" text-sm font-light" >
                            <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="logs in logEntries" :key="logs.id">
                                <td class="py-3 px-5 text-left whitespace-nowrap">
                                    <div class="flex items-center">

                                        <p class="font-medium">{{ logs.id }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-5 text-left whitespace-nowrap">
                                    <div class="flex items-center">

                                        <p class="font-medium">{{ logs.log_entry }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-5 text-left whitespace-nowrap">
                                    <div class="flex items-center">

                                        <p class="font-medium">{{ logs.type }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium">{{ formattedDate(logs.created_at) }}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </SideBarLayout>

</template>
