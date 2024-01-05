<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <GuestLayout>

        <template #log>

            <div class=" min-h-screen flex items-center justify-center px-5 py-5">
                <div class="bg-black bg-opacity-75 text-gray-500 rounded shadow-xl w-1/2 overflow-hidden" style="max-width:425px; z-index: 1;">
                    <div class="md:flex w-full">
                        <div class="w-11/12 md:full ms-4 py-14 px-14 md:px-10">
                            <div class="text-start mb-7">
                                <h1 class="font-bold text-3xl text-white">Create Account</h1>
                            </div>
                            <form @submit.prevent="submit">
                                <div>

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full text-black"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        placeholder="Username"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="mt-4">

                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full text-black"
                                        v-model="form.email"
                                        required
                                        autocomplete="email"
                                        placeholder="Email"
                                    />

                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="mt-4">

                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full text-black"
                                        v-model="form.password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Password"
                                    />

                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="mt-4">

                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full text-black"
                                        v-model="form.password_confirmation"
                                        required
                                        autocomplete="new-password"
                                        placeholder="Confirm Password"
                                    />

                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>

                                <div class="mt-10">
                                    <button type="submit" class="w-full flex justify-center bg-red-600 text-gray-100 p-3  rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500 mb-4">
                                        Get Started ->
                                    </button>
                                </div>

                                <div class="flex-grow-1 mt-10">
                                    <p style="color: #a19696">Already have an account?
                                        <Link :href="route('login')" class="text-white" @mouseover="$event.target.classList.add('underline')" @mouseout="$event.target.classList.remove('underline')">
                                            Log in now.
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
