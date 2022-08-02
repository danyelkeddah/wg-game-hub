<script setup>
import { defineProps, onMounted } from 'vue';
import BorderedContainer from '@/Shared/BorderedContainer';
import GameCard from '@/Shared/GameCard';
import dayjs from 'dayjs';
import ButtonShape from '@/Shared/ButtonShape';
import RocketIcon from '@/Shared/SVG/RocketIcon';
import SettingsIcon from '@/Shared/SVG/SettingsIcon';
import MedalIcon from '@/Shared/SVG/MedalIcon';
import WatchIcon from '@/Shared/SVG/WatchIcon';

let utc = require('dayjs/plugin/utc');
let timezone = require('dayjs/plugin/timezone');
let relativeTime = require('dayjs/plugin/relativeTime');
let duration = require('dayjs/plugin/duration');
import { Link } from '@inertiajs/inertia-vue3';
import { useCurrentUser } from '@/Composables/useCurrentUser';

let currentUser = useCurrentUser();
dayjs.extend(utc);
dayjs.extend(timezone);
dayjs.extend(relativeTime);
dayjs.extend(duration);

let props = defineProps({
    lastGamePlayed: Object,
    latestGamesPlayedHistory: Object,
    latestAchievements: Object,
    totalTimePlayed: Number,
    topPlayedGamesTimeSpent: Object,
});

function UTCToHumanReadable(u) {
    return dayjs(u).utc().local().tz(dayjs.tz.guess()).format('MMMM DD, YYYY hh:mm A');
}

function timePlayedSecondsToHours(s) {
    return dayjs.duration({ seconds: s }).humanize();
}
</script>

<template>
    <div class="grid grid-flow-row gap-y-8">
        <section class="overflow-x-scroll">
            <BorderedContainer class="mb-9 bg-wgh-gray-1.5">
                <div class="flex flex-col justify-between rounded-lg bg-white p-6 md:flex-row">
                    <div class="flex flex-row items-start space-x-5 lg:items-center">
                        <BorderedContainer class="shrink-0 bg-wgh-purple-3">
                            <div class="rounded-lg bg-white">
                                <img
                                    :src="currentUser.image_url"
                                    alt="user profile image"
                                    class="h-12 w-12 object-cover md:h-24 md:w-24"
                                />
                            </div>
                        </BorderedContainer>
                        <div class="flex flex-col space-y-2">
                            <div class="flex flex-row items-start justify-between">
                                <h1 class="font-grota text-lg font-extrabold capitalize text-wgh-gray-6">
                                    {{ currentUser.full_name }}
                                </h1>
                                <Link class="space-x-2 font-inter text-xs font-normal text-wgh-gray-4 md:hidden">
                                    <SettingsIcon class="h-4 w-4" />
                                </Link>
                            </div>
                            <p class="font-inter text-sm font-normal text-wgh-gray-4">
                                <span class="mr-2">🇨🇱</span> Chile
                            </p>
                            <p class="font-enter text-base font-normal text-black">🎮 Keep calm and game on 🕹</p>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col justify-between lg:mt-0">
                        <Link
                            class="hidden flex-row justify-end space-x-2 font-inter text-xs font-normal text-wgh-gray-4 md:flex"
                            ><span>settings</span>
                            <SettingsIcon class="h-4 w-4" />
                        </Link>
                        <div class="flex flex-row lg:space-x-8">
                            <div class="flex flex-row space-x-2">
                                <div class="rounded-full bg-wgh-pink-1 p-3">
                                    <MedalIcon class="h-7 w-7 text-wgh-purple-2" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                        >won</span
                                    >
                                    <span class="font-grota text-sm font-normal uppercase text-wgh-gray-6">37 USD</span>
                                </div>
                            </div>
                            <div class="flex flex-row space-x-2">
                                <div class="rounded-full bg-wgh-pink-1 p-3">
                                    <RocketIcon class="h-7 w-7 text-wgh-purple-2" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                        >payed</span
                                    >
                                    <span class="font-grota text-sm font-normal uppercase text-wgh-gray-6"
                                        >18 times</span
                                    >
                                </div>
                            </div>
                            <div class="flex flex-row space-x-2">
                                <div class="rounded-full bg-wgh-pink-1 p-3">
                                    <WatchIcon class="h-7 w-7 text-wgh-purple-2" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                        >spent</span
                                    >
                                    <span class="font-grota text-sm font-normal uppercase text-wgh-gray-6">15H</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </BorderedContainer>
        </section>

        <section class="overflow-x-scroll">
            <div class="flex flex-col">
                <h2 class="mb-6 font-grota text-2xl font-extrabold uppercase text-wgh-gray-6">Summary</h2>
                <div class="flex flex-1 flex-wrap gap-4">
                    <section class="flex-1 grow">
                        <p class="mb-2 font-grota text-sm font-semibold">
                            Total Game Play:
                            {{ timePlayedSecondsToHours(totalTimePlayed) }}
                        </p>
                        <BorderedContainer class="bg-wgh-gray-1.5">
                            <div class="rounded-lg">
                                <div class="flex flex-col">
                                    <div class="overflow-x-auto">
                                        <div class="inline-block min-w-full align-middle">
                                            <div
                                                class="overflow-hidden rounded-lg shadow-sm ring-1 ring-black ring-opacity-5"
                                            >
                                                <table class="min-w-full divide-y divide-gray-300">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th
                                                                scope="col"
                                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"
                                                            >
                                                                Game
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Total Time
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200 bg-white">
                                                        <tr v-for="item in topPlayedGamesTimeSpent" :key="item.game.id">
                                                            <td
                                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                                            >
                                                                {{ item.game.name }}
                                                            </td>
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                            >
                                                                {{
                                                                    timePlayedSecondsToHours(
                                                                        item.total_time_played
                                                                    ).toLocaleString()
                                                                }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BorderedContainer>
                    </section>
                </div>
            </div>
        </section>

        <section class="overflow-x-scroll">
            <h2 class="mb-6 font-grota text-2xl font-extrabold uppercase text-wgh-gray-6">Last Played</h2>

            <BorderedContainer class="bg-wgh-gray-1.5">
                <div class="flex w-full flex-col rounded-lg bg-white p-6 md:flex-row">
                    <div class="flex w-full flex-col space-y-4 md:w-2/3 md:flex-row md:space-y-0 md:space-x-4">
                        <img
                            :src="lastGamePlayed.image_url"
                            :alt="`${lastGamePlayed.name} art`"
                            class="aspect-[16/9] rounded-lg md:mb-0 md:max-h-[6.25rem]"
                        />
                        <div class="flex flex-col justify-center">
                            <h3 class="font-grota text-base font-bold uppercase text-wgh-gray-6">
                                {{ lastGamePlayed.name }}
                            </h3>
                            <p class="mb-4 font-inter text-sm font-normal text-wgh-gray-4">
                                {{ lastGamePlayed.description }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="mt-4 flex flex-col items-center justify-end md:mt-0 md:w-1/3 md:flex-row md:items-baseline"
                    >
                        <Link :href="`/games/${lastGamePlayed.id}`">
                            <ButtonShape type="red">
                                <span>Play Again</span>
                            </ButtonShape>
                        </Link>
                    </div>
                </div>
            </BorderedContainer>
        </section>
        <section class="overflow-x-scroll">
            <div class="mb-6 flex flex-row flex-wrap items-center justify-between">
                <h2 class="font-grota text-2xl font-extrabold uppercase text-wgh-gray-6">
                    Latest Games Played History
                </h2>
                <Link :href="route('user.achievements', { user: currentUser.username })">
                    <ButtonShape type="red"> View All</ButtonShape>
                </Link>
            </div>
            <BorderedContainer class="bg-wgh-gray-1.5">
                <div class="rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-black ring-opacity-5">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Date
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Score
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Rank
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="scoreItem in latestGamesPlayedHistory" :key="scoreItem.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                                >
                                                    {{ scoreItem.game.name }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ UTCToHumanReadable(scoreItem.game_lobby.scheduled_at) }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ scoreItem.score }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    #{{ scoreItem.rank }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </BorderedContainer>
        </section>
        <section class="overflow-x-scroll">
            <div class="mb-6 flex flex-row flex-wrap items-center justify-between">
                <h2 class="font-grota text-2xl font-extrabold uppercase text-wgh-gray-6">Latest Achievements</h2>
                <Link :href="`/w/${currentUser.username}/achievements`">
                    <ButtonShape type="red"> View All</ButtonShape>
                </Link>
            </div>
            <BorderedContainer class="bg-wgh-gray-1.5">
                <div class="rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-black ring-opacity-5">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Game
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Date
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Description
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="userAchievement in latestAchievements" :key="userAchievement.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                                >
                                                    {{ userAchievement.achievement.name }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ userAchievement.game.name }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ UTCToHumanReadable(userAchievement.created_at) }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ userAchievement.achievement.description }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </BorderedContainer>
        </section>
    </div>
</template>
