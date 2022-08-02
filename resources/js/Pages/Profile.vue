<script setup>
import BorderedContainer from '@/Shared/BorderedContainer';
import { Link } from '@inertiajs/inertia-vue3';
import SettingsIcon from '@/Shared/SVG/SettingsIcon';
import MedalIcon from '@/Shared/SVG/MedalIcon';
import RocketIcon from '@/Shared/SVG/RocketIcon';
import WatchIcon from '@/Shared/SVG/WatchIcon';
import BananoIcon from '@/Shared/SVG/BananoIcon';
import CopyIcon from '@/Shared/SVG/CopyIcon';
import ButtonShape from '@/Shared/ButtonShape';
import { ref } from 'vue';
import { useCurrentUser } from '@/Composables/useCurrentUser';
import BananoCoinIcon from '@/Shared/SVG/BananoCoinIcon';
import EthereumCoinIcon from '@/Shared/SVG/EthereiumCoinIcon';
import BinanceCoinIcon from '@/Shared/SVG/BinanceCoinIcon';
import NanoCoinIcon from '@/Shared/SVG/NanoCoinIcon';

let activeTransactionNetwork = ref('banano');

let currentUser = useCurrentUser();
</script>
<template>
    <div>
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
                                <SettingsIcon class="h-4 w-4"
                            /></Link>
                        </div>
                        <p class="font-inter text-sm font-normal text-wgh-gray-4"><span class="mr-2">🇨🇱</span> Chile</p>
                        <p class="font-enter text-base font-normal text-black">🎮 Keep calm and game on 🕹</p>
                    </div>
                </div>
                <div class="mt-4 flex flex-col justify-between lg:mt-0">
                    <Link
                        class="hidden flex-row justify-end space-x-2 font-inter text-xs font-normal text-wgh-gray-4 md:flex"
                        ><span>settings</span> <SettingsIcon class="h-4 w-4"
                    /></Link>
                    <div class="flex flex-row lg:space-x-8">
                        <div class="flex flex-row space-x-2">
                            <div class="rounded-full bg-wgh-pink-1 p-3">
                                <MedalIcon class="h-7 w-7 text-wgh-purple-2" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2">won</span>
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
                                <span class="font-grota text-sm font-normal uppercase text-wgh-gray-6">18 times</span>
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
        <div class="flex flex-col space-y-6 lg:flex-row lg:space-y-0 lg:space-x-6">
            <div class="basis-1/2">
                <div class="mb-6 flex h-14 flex-row items-center justify-between">
                    <h2 class="font-grota text-2xl font-extrabold uppercase text-wgh-gray-6">My ACTIVITIES</h2>
                </div>
                <BorderedContainer class="bg-wgh-gray-1.5">
                    <div class="flex flex-col rounded-lg bg-white p-6">
                        <div class="overflow-auto">
                            <div class="inline-block min-w-full align-middle">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="text-left font-inter text-xs font-normal uppercase text-wgh-gray-2">
                                            <th scope="col" class="py-2">Game</th>
                                            <th scope="col" class="py-2">Option</th>
                                            <th scope="col" class="py-2">Rank</th>
                                            <th scope="col" class="py-2">Prize</th>
                                            <th scope="col" class="py-2">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                                        <tr class="font-grota uppercase">
                                            <td class="py-4 pr-3 text-sm font-bold text-wgh-gray-6 sm:pl-6 md:pl-0">
                                                SNAKE.IO
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                Forever Game
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                #26
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                32
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                10
                                            </td>
                                        </tr>
                                        <tr class="font-grota uppercase">
                                            <td class="py-4 pr-3 text-sm font-bold text-wgh-gray-6 sm:pl-6 md:pl-0">
                                                SNAKE.IO
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                Forever Game
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                #26
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                32
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                10
                                            </td>
                                        </tr>
                                        <tr class="font-grota uppercase">
                                            <td class="py-4 pr-3 text-sm font-bold text-wgh-gray-6 sm:pl-6 md:pl-0">
                                                SNAKE.IO
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                Forever Game
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                #26
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                32
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                10
                                            </td>
                                        </tr>
                                        <tr class="font-grota uppercase">
                                            <td class="py-4 pr-3 text-sm font-bold text-wgh-gray-6 sm:pl-6 md:pl-0">
                                                SNAKE.IO
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                Forever Game
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                #26
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                32
                                            </td>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                            >
                                                10
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </BorderedContainer>
            </div>
            <div class="grow basis-0">
                <div class="mb-6 flex h-14 shrink-0 flex-row items-center justify-between">
                    <h2 class="font-grota text-2xl font-extrabold uppercase text-wgh-gray-6">My TRANSACTIONS</h2>
                    <button>
                        <ButtonShape type="gray">
                            <span>TOP UP</span>
                        </ButtonShape>
                    </button>
                    <!--                    <WGHButton type="gray" class="px-8">  </WGHButton>-->
                </div>

                <BorderedContainer class="bg-wgh-gray-1.5">
                    <div class="rounded-lg bg-white p-6">
                        <BorderedContainer class="mb-4 bg-wgh-gray-0.5">
                            <div class="container-snap flex w-full snap-x scroll-pl-6 gap-8 overflow-x-auto py-4">
                                <div class="relative shrink-0 snap-start scroll-ml-6 first:pl-6 last:pr-6">
                                    <div class="bg-stripes-pink absolute top-0 left-0 bottom-0 w-6"></div>
                                    <div
                                        class="flex flex-1 basis-1/3 cursor-pointer flex-row items-center space-x-4 rounded-lg p-3 transition-all duration-100"
                                        :class="{
                                            'bg-wgh-pink-1': activeTransactionNetwork === 'banano',
                                        }"
                                        @click.prevent="activeTransactionNetwork = 'banano'"
                                    >
                                        <BananoCoinIcon class="h-6 w-6" />
                                        <div class="flex flex-col">
                                            <p class="font-inter text-xs font-normal uppercase text-wgh-gray-2">
                                                Banano Balance
                                            </p>
                                            <p class="text-sm font-extrabold text-wgh-gray-6">1828</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative shrink-0 snap-start scroll-ml-6 first:pl-6 last:pr-6">
                                    <div class="bg-stripes-pink absolute top-0 -left-6 bottom-0 w-6"></div>
                                    <div
                                        class="flex basis-1/3 cursor-pointer flex-row items-center space-x-4 rounded-lg p-3 transition-all duration-100"
                                        :class="{
                                            'bg-wgh-pink-1': activeTransactionNetwork === 'ethereum',
                                        }"
                                        @click.prevent="activeTransactionNetwork = 'ethereum'"
                                    >
                                        <EthereumCoinIcon class="h-6 w-6" />
                                        <div class="flex flex-col">
                                            <p class="font-inter text-xs font-normal uppercase text-wgh-gray-2">
                                                Ethereum Balance
                                            </p>
                                            <p class="text-sm font-extrabold text-wgh-gray-6">1828</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative shrink-0 snap-start scroll-ml-6 first:pl-6 last:pr-6">
                                    <div class="bg-stripes-pink absolute top-0 -left-6 bottom-0 w-6"></div>
                                    <div
                                        class="flex basis-1/3 cursor-pointer flex-row items-center space-x-4 rounded-lg p-3 transition-all duration-100"
                                        :class="{
                                            'bg-wgh-pink-1': activeTransactionNetwork === 'bnb',
                                        }"
                                        @click.prevent="activeTransactionNetwork = 'bnb'"
                                    >
                                        <BinanceCoinIcon class="h-6 w-6" />
                                        <div class="flex flex-col">
                                            <p class="font-inter text-xs font-normal uppercase text-wgh-gray-2">
                                                Binance Coin Balance
                                            </p>
                                            <p class="text-sm font-extrabold text-wgh-gray-6">1828</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative shrink-0 snap-start scroll-ml-6 first:pl-6 last:pr-6">
                                    <div class="bg-stripes-pink absolute top-0 -left-6 bottom-0 w-6"></div>
                                    <div
                                        class="flex basis-1/3 cursor-pointer flex-row items-center space-x-4 rounded-lg p-3 transition-all duration-100"
                                        :class="{
                                            'bg-wgh-pink-1': activeTransactionNetwork === 'nano',
                                        }"
                                        @click.prevent="activeTransactionNetwork = 'nano'"
                                    >
                                        <NanoCoinIcon class="h-6 w-6" />
                                        <div class="flex flex-col">
                                            <p class="font-inter text-xs font-normal uppercase text-wgh-gray-2">
                                                Nano Coin Balance
                                            </p>
                                            <p class="text-sm font-extrabold text-wgh-gray-6">1828</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BorderedContainer>
                        <div
                            class="flex flex-row items-center justify-between space-x-8 overflow-x-scroll rounded-lg bg-wgh-gray-0.5 p-2.5"
                        >
                            <p ref="walletAddress" class="font-inter text-xs text-base font-normal text-wgh-gray-2">
                                1PQi1jwKr4cnfFYKgeHAAZZZZZZZZZZZZZZZZZZZZZZZ
                            </p>
                            <button @click.prevent="">
                                <CopyIcon />
                            </button>
                        </div>
                        <div class="flex flex-col">
                            <div class="overflow-x-auto">
                                <div class="inline-block min-w-full align-middle">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                                            <tr>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    No #2137642
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    28/08/21, 18:30
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-bold text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    +882
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    No #2137642
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    28/08/21, 18:30
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-bold text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    +882
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    No #2137642
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    28/08/21, 18:30
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-bold text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    +882
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    No #2137642
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-normal text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    28/08/21, 18:30
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 font-inter text-sm text-base font-bold text-wgh-gray-6 sm:pl-6 md:pl-0"
                                                >
                                                    +882
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </BorderedContainer>
            </div>
        </div>
    </div>
</template>
