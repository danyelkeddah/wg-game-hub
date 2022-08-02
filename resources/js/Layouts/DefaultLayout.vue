<script setup>
import LogoRed from '@/Shared/SVG/LogoRed';

import NavigationItem from '@/Shared/Navigation/NavigationItem';
import RocketIcon from '@/Shared/SVG/RocketIcon';
import AccountIcon from '@/Shared/SVG/AccountIcon';
import Footer from '@/Shared/Footer/Footer';
import ButtonShape from '@/Shared/ButtonShape';
import { Link } from '@inertiajs/inertia-vue3';

import { Popover, PopoverButton, PopoverOverlay, PopoverPanel, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { MenuIcon, XIcon, BellIcon } from '@heroicons/vue/outline';
import { useCurrentUser } from '@/Composables/useCurrentUser';

const navigation = [{ name: 'Dashboard', href: route('landing'), current: true, external: false }];
const userNavigation = [
    { name: 'Your Profile', href: route('user.profile', { user: useCurrentUser().username }), external: false },
    { name: 'Sign out', href: '#' },
];
let currentUser = useCurrentUser();

let props = defineProps({
    config: Object,
});
</script>
<template>
    <div
        id="wrapper"
        class="flex min-h-screen w-full flex-col justify-between bg-[#F6F6F7]"
        :style="{
            backgroundImage: `url(${props.config.main_pattern})`,
            backgroundRepeat: `repeat`,
            backgroundPosition: `center`,
        }"
    >
        <div class="mb-6 w-full bg-white">
            <nav class="container mx-auto flex hidden flex-row justify-between px-4 lg:flex">
                <div class="flex flex-row items-center space-x-14 py-5">
                    <Link :href="route('landing')">
                        <LogoRed class="w-32" />
                    </Link>
                    <div class="flex flex-row space-x-6">
                        <NavigationItem :href="link.href" as="link" v-for="link in navigation" :key="link.name">
                            <RocketIcon class="h-6 w-6" />
                            <span>{{ link.name }}</span></NavigationItem
                        >
                    </div>
                </div>
                <div class="hidden flex-row items-center space-x-8 lg:flex">
                    <!--                    <SearchIcon class="h-6 w-6 cursor-pointer" />-->
                    <!--                    <BellIcon class="h-6 w-6 cursor-pointer" />-->
                    <Link v-if="currentUser" :href="route('user.profile', { user: currentUser.username })">
                        <ButtonShape type="purple">
                            <span class="flex flex-row space-x-2.5">
                                <AccountIcon class="h-6 w-6" />
                                <span class="font-bold uppercase">{{ currentUser.name }}</span>
                            </span>
                        </ButtonShape>
                    </Link>
                    <Link v-if="!currentUser" :href="route('login')">
                        <ButtonShape type="purple">
                            <span class="flex flex-row space-x-2.5">
                                <span class="font-bold uppercase">Login / Register</span>
                            </span>
                        </ButtonShape>
                    </Link>
                </div>
            </nav>
            <div
                class="container mx-auto flex w-full flex-shrink-0 flex-row items-center justify-between bg-white px-4 lg:hidden"
            >
                <Link :href="route('landing')">
                    <LogoRed class="w-32 py-5" />
                </Link>

                <!-- Mobile menu button -->
                <Popover as="header" class="bg-white" v-slot="{ open }">
                    <!-- Menu button -->

                    <!-- Mobile menu button -->
                    <PopoverButton
                        class="inline-flex items-center justify-center rounded-md bg-transparent p-2 text-indigo-200 hover:bg-white hover:bg-opacity-10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                    >
                        <span class="sr-only">Open main menu</span>
                        <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </PopoverButton>

                    <TransitionRoot as="template" :show="open">
                        <div class="lg:hidden">
                            <TransitionChild
                                as="template"
                                enter="duration-150 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-150 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <PopoverOverlay class="fixed inset-0 z-20 bg-black bg-opacity-25" />
                            </TransitionChild>

                            <TransitionChild
                                as="template"
                                enter="duration-150 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-150 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <PopoverPanel
                                    focus
                                    class="absolute inset-x-0 top-0 z-30 mx-auto w-full max-w-3xl origin-top transform p-2 transition"
                                >
                                    <div
                                        class="divide-y divide-gray-200 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                                    >
                                        <div class="pt-3 pb-2">
                                            <div class="flex items-center justify-between px-4">
                                                <div>
                                                    <Link :href="route('landing')">
                                                        <LogoRed class="h-8 w-auto" />
                                                    </Link>
                                                    <!--                                                    <img-->
                                                    <!--                                                        class="h-8 w-auto"-->
                                                    <!--                                                        src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"-->
                                                    <!--                                                        alt="Workflow"-->
                                                    <!--                                                    />-->
                                                </div>
                                                <div class="-mr-2">
                                                    <PopoverButton
                                                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                                    >
                                                        <span class="sr-only">Close menu</span>
                                                        <XIcon class="h-6 w-6" aria-hidden="true" />
                                                    </PopoverButton>
                                                </div>
                                            </div>
                                            <div class="mt-3 space-y-1 px-2">
                                                <NavigationItem
                                                    class="block rounded-md px-3 py-2 text-base font-medium"
                                                    :href="link.href"
                                                    as="link"
                                                    v-for="link in navigation"
                                                    :key="link.name"
                                                >
                                                    <RocketIcon class="h-6 w-6" />
                                                    <span>{{ link.name }}</span></NavigationItem
                                                >
                                            </div>
                                        </div>
                                        <div v-if="currentUser" class="pt-4 pb-2">
                                            <div class="flex items-center px-5">
                                                <div class="aspect-square flex-shrink-0">
                                                    <img
                                                        class="h-10 w-10 rounded-full"
                                                        :src="currentUser.image_url"
                                                        alt=""
                                                    />
                                                </div>
                                                <div class="ml-3 min-w-0 flex-1">
                                                    <div class="truncate text-base font-medium text-gray-800">
                                                        {{ currentUser.full_name }}
                                                    </div>
                                                    <div class="truncate text-sm font-medium text-gray-500">
                                                        {{ currentUser.email }}
                                                    </div>
                                                </div>
                                                <button
                                                    type="button"
                                                    class="ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                >
                                                    <span class="sr-only">View notifications</span>
                                                    <BellIcon class="h-6 w-6" aria-hidden="true" />
                                                </button>
                                            </div>
                                            <div class="mt-3 space-y-1 px-2">
                                                <a
                                                    v-for="item in userNavigation"
                                                    :key="item.name"
                                                    :href="item.href"
                                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800"
                                                    >{{ item.name }}</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </PopoverPanel>
                            </TransitionChild>
                        </div>
                    </TransitionRoot>
                </Popover>
            </div>
        </div>
        <div class="container mx-auto flex h-full flex-1 flex-grow flex-col px-4 lg:mt-0" scroll-region>
            <!--            <transition name="page">-->
            <slot />
            <!--            </transition>-->
        </div>
        <div class="mx-auto mt-8 w-full bg-white py-2">
            <Footer />
        </div>
    </div>
</template>

<style scoped>
.page-enter-active,
.page-leave-active {
    transition: all 0.3s;
}

.page-enter,
.page-leave-active {
    opacity: 0;
}
</style>
