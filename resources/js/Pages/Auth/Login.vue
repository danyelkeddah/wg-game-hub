<script setup>
import Logo from '@/Shared/SVG/Logo';
import TextInput from '@/Shared/Inputs/TextInput';
import { ref, onMounted } from 'vue';
import InputError from '@/Shared/InputError';
import ButtonShape from '@/Shared/ButtonShape';
import { useForm } from '@inertiajs/inertia-vue3';

let isRegister = ref(false);

let props = defineProps({
    login_art: {
        type: String,
        required: true,
    },
    is_login: {
        type: Boolean,
        required: false,
        default: true,
    },
});

onMounted(() => {
    if (props.is_login) {
        switchToLogin();
    } else {
        switchToRegister();
    }
});
let loginForm = useForm({
    email: '',
    password: '',
    remember_me: false,
});
let registerForm = useForm({
    name: '',
    last_name: '',
    email: '',
    username: '',
    password: '',
    password_confirmation: '',
});

function isFormProcessingNow() {
    return loginForm.processing || registerForm.processing;
}

function switchToLogin() {
    if (isFormProcessingNow()) {
        return;
    }
    loginForm.clearErrors();
    loginForm.reset();
    isRegister.value = false;
}

function switchToRegister() {
    if (isFormProcessingNow()) {
        return;
    }
    registerForm.clearErrors();
    registerForm.reset();

    isRegister.value = true;
}

function loginSubmit() {
    loginForm.post('/login');
}

function registerSubmit() {
    registerForm.post('/register');
}
</script>

<template>
    <div
        class="mx-auto flex min-h-screen max-w-6xl flex-col justify-around px-4"
    >
        <div class="flex flex-row items-center justify-between space-x-12">
            <div class="w-full lg:w-4/12">
                <Logo class="mx-auto mb-8 w-32" />

                <div
                    class="relative mb-8 flex flex-row rounded-lg border-t-4 border-r-4 border-l-4 border-b-10 border-[#B7BAC6] bg-white p-1"
                >
                    <span
                        class="block w-1/2 cursor-pointer rounded py-2 text-center font-grota text-sm font-bold uppercase transition-all duration-200"
                        :class="{
                            'bg-wgh-gray-3 text-white': !isRegister,
                            'text-wgh-gray-3': isRegister,
                        }"
                        @click.prevent="switchToLogin"
                        >Sign in</span
                    >
                    <span
                        class="block w-1/2 cursor-pointer rounded py-2 text-center font-grota text-sm font-bold uppercase transition-all duration-200"
                        :class="{
                            'bg-wgh-gray-3 text-white': isRegister,
                            'text-wgh-gray-3': !isRegister,
                        }"
                        @click.prevent="switchToRegister"
                        >Sign up</span
                    >
                </div>

                <div class="mb-5">
                    <form @submit.prevent="loginSubmit" v-if="!isRegister">
                        <TextInput
                            name="email"
                            placeholder="Email"
                            type="email"
                            v-model="loginForm.email"
                        />
                        <InputError class="mt-2">
                            <div v-if="loginForm.errors.email" class="mt-2">
                                {{ loginForm.errors.email }}
                            </div>
                        </InputError>

                        <TextInput
                            v-model="loginForm.password"
                            placeholder="Password"
                            type="password"
                            id="password"
                            name="password"
                            class="mt-4"
                        />
                        <InputError class="mt-2">
                            <div v-if="loginForm.errors.password" class="mt-2">
                                {{ loginForm.errors.password }}
                            </div>
                        </InputError>
                        <div class="mb-6 mt-4 flex flex-row justify-between">
                            <div class="flex flex-row items-center space-x-2">
                                <input
                                    type="checkbox"
                                    id="remember_me"
                                    name="remember_me"
                                    class="rounded border border-wgh-gray-3"
                                />
                                <label
                                    for="remember_me"
                                    class="font-grota uppercase text-wgh-gray-6"
                                    >REMEMBER ME</label
                                >
                            </div>
                            <a
                                class="font-grota text-sm font-normal uppercase text-wgh-gray-6 underline"
                                href="#"
                                >forgot password</a
                            >
                        </div>
                        <button
                            type="submit"
                            class="w-full"
                            :disabled="loginForm.processing"
                        >
                            <ButtonShape type="purple">
                                <span class="w-full uppercase">Sign in</span>
                            </ButtonShape>
                        </button>
                    </form>
                    <form @submit.prevent="registerSubmit" v-if="isRegister">
                        <TextInput
                            name="name"
                            placeholder="Name"
                            type="text"
                            v-model="registerForm.name"
                        />
                        <InputError class="mt-2">
                            <div v-if="registerForm.errors.name" class="mt-2">
                                {{ registerForm.errors.name }}
                            </div>
                        </InputError>
                        <TextInput
                            name="last_name"
                            placeholder="Last name"
                            type="text"
                            v-model="registerForm.last_name"
                            class="mt-4"
                        />
                        <InputError class="mt-2">
                            <div
                                v-if="registerForm.errors.last_name"
                                class="mt-2"
                            >
                                {{ registerForm.errors.last_name }}
                            </div>
                        </InputError>
                        <TextInput
                            name="email"
                            placeholder="Email"
                            type="email"
                            v-model="registerForm.email"
                            class="mt-4"
                        />
                        <InputError class="mt-2">
                            <div v-if="registerForm.errors.email" class="mt-2">
                                {{ registerForm.errors.email }}
                            </div>
                        </InputError>

                        <TextInput
                            name="username"
                            placeholder="Username"
                            type="text"
                            v-model="registerForm.username"
                            class="mt-4"
                        />
                        <InputError class="mt-2">
                            <div
                                v-if="registerForm.errors.username"
                                class="mt-2"
                            >
                                {{ registerForm.errors.username }}
                            </div>
                        </InputError>

                        <TextInput
                            v-model="registerForm.password"
                            placeholder="Password"
                            type="password"
                            id="password"
                            name="password"
                            class="mt-4"
                        />
                        <InputError class="mt-2">
                            <div
                                v-if="registerForm.errors.password"
                                class="mt-2"
                            >
                                {{ registerForm.errors.password }}
                            </div>
                        </InputError>

                        <TextInput
                            v-model="registerForm.password_confirmation"
                            placeholder="Confirm Password"
                            name="confirmPassword"
                            type="password"
                            id="password_confirmation"
                            class="mb-6 mt-4"
                        />
                        <InputError class="mt-2">
                            <div
                                v-if="registerForm.errors.password_confirmation"
                                class="mt-2"
                            >
                                {{ registerForm.errors.password_confirmation }}
                            </div>
                        </InputError>
                        <button
                            type="submit"
                            class="w-full"
                            :disabled="registerForm.processing"
                        >
                            <ButtonShape type="purple">
                                <span class="w-full uppercase">Sign up</span>
                            </ButtonShape>
                        </button>
                    </form>
                </div>
                <p
                    class="text-center font-inter text-sm capitalize text-[#909399]"
                >
                    By Signing In you’re agreeing to the
                    <a href="#" class="underline">Terms & Conditions</a> and
                    <a href="#" class="underline">Privacy Policy.</a>
                </p>
            </div>
            <img
                :src="login_art"
                alt="Login Art"
                class="hidden lg:block lg:w-7/12"
            />
        </div>
    </div>
</template>

<script>
import AuthLayout from '@/Layouts/AuthLayout';

export default {
    layout: AuthLayout,
    //
    // data() {
    //     return {
    //         email: '',
    //         password: '',
    //         confirmPassword: '',
    //     };
    // },
    // methods: {
    //     handleInputChange(data) {
    //         console.log(data);
    //         this[data.name] = data.value;
    //     },
    //     submit(e) {
    //         e.preventDefault();
    //         if (this.isRegister == false) {
    //             let loginInformation = {};
    //             loginInformation.email = this.email;
    //             loginInformation.password = this.password;
    //             Inertia.post('/login', loginInformation);
    //         }
    //         if (this.isRegister == true) {
    //             let registerInformation = {};
    //             registerInformation.email = this.email;
    //             registerInformation.password = this.password;
    //             registerInformation.password_confirmation =
    //                 this.confirmPassword;
    //             registerInformation.username = 'the script';
    //             Inertia.post('/register', registerInformation);
    //         }
    //     },
    // },
};
</script>
