<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template >
    <Head title="Log in" />
    <GuestLayout>

        <template #log>

            <div class=" min-h-screen flex items-center justify-center px-5 py-5">
                <div class="bg-black bg-opacity-75 text-gray-500 rounded shadow-xl w-1/2 overflow-hidden" style="max-width:425px; z-index: 1;">
                    <div class="md:flex w-full">
                        <div class="w-11/12 md:full ms-4 py-14 px-14 md:px-10">

                            <div v-if="status" class="mb-6 font-medium text-sm text-green-600">
                                {{ status }}
                            </div>
                            <div v-if="$page.props.flash.success" id="flash-success-message" class="mb-6 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                                {{ $page.props.flash.success }}
                                <div class="progress-bar success"></div>
                            </div>

                            <div v-if="$page.props.flash.error" id="flash-error-message" class="mb-6 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                                {{ $page.props.flash.error }}
                                <div class="progress-bar error"></div>
                            </div>

                            <div class="text-start mb-7">
                                <h1 class="font-bold text-3xl text-white">Sign in</h1>
                            </div>
                            <form @submit.prevent="submit" >
                                <div>
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="mt-1 block w-full text-black"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="Email"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="mt-4">
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        class="mt-1 block w-full text-black"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Password"
                                    />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="mt-10">
                                    <button type="submit" class="w-full flex justify-center bg-red-600 text-gray-100 p-3  rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500 mb-4">
                                    Sign In
                                </button>
                                </div>

                                <div class="flex-grow-1 mt-10">
                                    <p style="color: #a19696">New to Netflix?
                                        <Link :href="route('register')" class="text-white" @mouseover="$event.target.classList.add('underline')" @mouseout="$event.target.classList.remove('underline')">
                                            Sign up now.
                                        </Link>
                                    </p>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </template>



    </GuestLayout>
</template>
