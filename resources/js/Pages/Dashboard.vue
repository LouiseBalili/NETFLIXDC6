<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue'
import {inject} from 'vue'
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import { ref, onMounted } from 'vue';

const themeMode = inject('themeMode')
const props = defineProps({
   tvshow:Number,
   movie:Number,

})

const { events } = usePage().props;

const calendarOptions = ref({
  plugins: [dayGridPlugin, timeGridPlugin],
  initialView: 'dayGridMonth',
  events: events,
  dayRender: function (info) {
    const date = info.date.toISOString().split('T')[0];
    const hasData = events.some(event => event.start === date);

    const cell = info.el;
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = `Plugin Data: ${info.dayNumberText}`;
    tooltip.style.display = hasData ? 'block' : 'none'; // initially hide the tooltip

    cell.appendChild(tooltip);

    cell.addEventListener('mouseenter', () => {
      tooltip.style.display = 'block'; // show the tooltip on hover
    });

    cell.addEventListener('mouseleave', () => {
      tooltip.style.display = 'none'; // hide the tooltip when mouse leaves
    });
  },
});

onMounted(() => {
  const calendarEl = document.getElementById('calendar');

  if (calendarEl) {
    const calendar = new Calendar(calendarEl, calendarOptions.value);
    calendar.render();
  }
});

</script>

<template>
    <Head title="Dashboard" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container justify-between grid">
                    <div class="grid mb-8 md:grid-cols-2 xl:grid-cols-2 ml-40"  >
                    <!-- Cards -->
                    <Card :class="themeMode">
                        <template #content>
                            <div class="flex items-center p-4  rounded-lg shadow-xs " >
                                <div class="p-3 mr-4 text-red-600 bg-pink-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0 1 18 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0 1 18 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 0 1 6 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5" />
                                    </svg>
                                </div>
                                <div class="flex">
                                    <p class="mb-2 text-lg font-medium text-black mr-24">
                                        Movies
                                    </p>
                                    <p class="text-2xl font-semibold text-red-500 rounded-full">
                                        {{ movie }}
                                    </p>
                                </div>
                            </div>
                        </template>
                     </Card>

                    <Card>
                        <template #content>
                            <div class="flex items-center p-4  rounded-lg shadow-xs">
                                <div class="p-3 mr-4 text-red-600 bg-pink-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                </div>
                                <div class="flex">
                                    <p class="mb-2 text-lg font-medium text-black mr-24">
                                        TV Shows
                                    </p>
                                    <p class="text-2xl font-semibold text-red-500 rounded-full">
                                        {{ tvshow }}
                                    </p>
                                </div>
                              </div>
                        </template>
                    </Card>

                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-white p-10" id="calendar"></div>
            </div>

    </div>

    </SideBarLayout>
</template>

<style scoped>
.tooltip {
  position: absolute;
  top: -20px; /* Adjust this value based on your design */
  left: 20px; /* Adjust this value based on your design */
  background-color: white;
  border: 1px solid #ccc;
  padding: 5px;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
</style>
