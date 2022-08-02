<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

import GameOptionsIcon from '@/Shared/SVG/GameOptionsIcon';
import GameLiveIcon from '@/Shared/SVG/GameLiveIcon';
import ButtonShape from '@/Shared/ButtonShape';
import BorderedContainer from '@/Shared/BorderedContainer';

let props = defineProps({
    game: Object,
});
</script>

<template>
    <BorderedContainer class="mb-5 bg-wgh-gray-1.5">
        <div class="flex w-full flex-col rounded-lg bg-white p-6 md:flex-row">
            <div class="flex w-full flex-col space-y-4 md:w-2/3 md:flex-row md:space-y-0 md:space-x-4">
                <img
                    :src="game.image_url"
                    :alt="`${game.name} art`"
                    class="aspect-[16/9] rounded-lg md:mb-0 md:max-h-[6.25rem]"
                />
                <div class="flex flex-col justify-center">
                    <h3 class="font-grota text-base font-bold uppercase text-wgh-gray-6">
                        {{ game.name }}
                    </h3>
                    <p class="mb-4 font-inter text-sm font-normal text-wgh-gray-4">
                        {{ game.description }}
                    </p>
                    <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-10">
                        <div class="flex flex-row items-center space-x-2 md:space-x-4">
                            <GameOptionsIcon class="h-6 w-6" />
                            <div class="flex flex-col">
                                <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                    >Game Options</span
                                >
                                <span class="font-grota text-sm font-normal uppercase text-wgh-gray-6"
                                    >{{ game.game_lobbies_count?.toLocaleString('en') }} Options</span
                                >
                            </div>
                        </div>
                        <div class="flex flex-row items-center space-x-2 md:space-x-4">
                            <GameLiveIcon class="h-6 w-6" />
                            <div class="flex flex-col">
                                <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                    >Online Players</span
                                >
                                <span class="font-grota text-sm font-normal uppercase text-wgh-gray-6">
                                    1000 Players</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex flex-col items-center justify-end md:mt-0 md:w-1/3 md:flex-row md:items-baseline">
                <Link :href="`/games/${game.id}`">
                    <ButtonShape type="red">
                        <span>Choose Game</span>
                    </ButtonShape>
                </Link>
            </div>
        </div>
    </BorderedContainer>
</template>
