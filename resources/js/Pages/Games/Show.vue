<script setup>
import GameOptionsIcon from '@/Shared/SVG/GameOptionsIcon';
import GameLiveIcon from '@/Shared/SVG/GameLiveIcon';
import BorderedContainer from '@/Shared/BorderedContainer';
import ButtonShape from '@/Shared/ButtonShape';
import ChevronLeft from '@/Shared/SVG/ChevronLeft';
import { Inertia } from '@inertiajs/inertia';

import { Link } from '@inertiajs/inertia-vue3';
import { reactive, ref } from 'vue';
import { isEmpty } from 'lodash';
import TentModal from '@/Shared/Modals/TentModal';
import ActiveSessionBanner from '@/Shared/ActiveSessionBanner';
import { useCurrentUser } from '@/Composables/useCurrentUser';
import Game from '@/Models/Game';

let currentUser = useCurrentUser();

let props = defineProps({
    game: Object,
    gameLobbies: Object,
    flash: Object,
});

let game = reactive(new Game(props.game.data));

let settings = reactive({
    startGameConfirmationModalIsOpen: false,
    selectedGameOption: {},
    isThereActiveLobbySession: () => {
        return !!currentUser?.current_lobby_session;
    },
    getActiveGameLobbySession: () => {
        return settings.isThereActiveLobbySession() ? currentUser.current_lobby_session : null;
    },
});

// Open Modal and set the selected game option
function startGameButtonClicked(gameOption) {
    if (!currentUser) {
        Inertia.visit('/login');
        return;
    }
    if (settings.isThereActiveLobbySession() && gameOption.id === settings.getActiveGameLobbySession().id) {
        Inertia.visit(`/game-lobbies/${gameOption.id}`);
        return;
    }
    settings.selectedGameOption = gameOption;

    settings.startGameConfirmationModalIsOpen = true;
}

function modalStartGameButtonClicked() {
    if (isEmpty(settings.selectedGameOption)) {
        return;
    }

    Inertia.post(`/game-lobbies/${settings.selectedGameOption.id}/join`);
    // Participate in session
    // and redirect to Lobby

    settings.startGameConfirmationModalIsOpen = false;
    // initialize the game
}

function modalCancelGameButtonClicked() {
    settings.startGameConfirmationModalIsOpen = false;
    // settings.selectedGameOption = {};
}
</script>

<template>
    <TentModal :open="settings.startGameConfirmationModalIsOpen">
        <template v-slot:header><p>Ready to Play!</p></template>
        <template v-slot:title>
            <p>{{ game.name }} - {{ settings.selectedGameOption.name }}</p>
        </template>
        <template v-slot:subtitle>
            <p class="wgh-gray-6 font-inter text-base font-normal">
                Entrance fee for this lobby is
                {{ settings.selectedGameOption?.base_entrance_fee }}
                {{ settings.selectedGameOption?.asset?.symbol }} <br />
                are you sure you want continue ?
            </p>
        </template>
        <template v-slot:actions>
            <button @click.prevent="modalCancelGameButtonClicked">
                <ButtonShape type="gray">
                    <span>Cancel</span>
                </ButtonShape>
            </button>
            <button @click.prevent="modalStartGameButtonClicked">
                <ButtonShape type="red">
                    <span>Start</span>
                </ButtonShape>
            </button>
        </template>
    </TentModal>
    <div>
        <BorderedContainer class="mb-10 bg-wgh-purple-3">
            <div class="flex flex-col justify-between rounded-lg bg-wgh-purple-2 p-7 md:flex-row">
                <div class="mb-4 flex flex-row space-x-6 lg:mb-0">
                    <Link :href="route('landing')">
                        <ButtonShape type="whiteBorderPurple">
                            <ChevronLeft class="text-white" />
                        </ButtonShape>
                    </Link>
                    <div class="flex flex-col space-y-2">
                        <h1 class="font-grota text-3xl font-extrabold uppercase text-white">
                            {{ game.name }}
                        </h1>
                        <p class="max-w-3xl font-inter text-sm font-normal text-white">
                            {{ game.description }}
                        </p>
                    </div>
                </div>
                <div class="flex shrink-0 flex-row divide-x divide-wgh-gray-0.5">
                    <div class="flex flex-row items-center space-x-2 pr-4 md:space-x-4">
                        <GameOptionsIcon class="h-6 w-6 text-white" />
                        <div class="flex flex-col">
                            <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                >Game Options</span
                            >
                            <span class="font-grota text-sm font-normal uppercase text-white"
                                >{{ gameLobbies.meta.total.toLocaleString('en') }} Options</span
                            >
                        </div>
                    </div>
                    <div class="flex flex-row items-center space-x-2 pl-4 md:space-x-4">
                        <GameLiveIcon class="h-6 w-6 text-white" />
                        <div class="flex flex-col">
                            <span class="font-inter text-[10px] font-semibold uppercase text-wgh-gray-2"
                                >Online Players</span
                            >
                            <span class="font-grota text-sm font-normal uppercase text-white"> 1000 Players</span>
                        </div>
                    </div>
                </div>
            </div>
        </BorderedContainer>
        <ActiveSessionBanner />
        <BorderedContainer
            v-if="flash.error"
            class="mb-8 flex flex-col space-y-6 border-wgh-red-3 bg-wgh-red-2 p-6 md:flex-row md:space-x-6 md:space-y-0"
        >
            <div class="rounded-lg p-4">
                <p class="font-grota text-2xl font-extrabold text-white">
                    {{ flash.error }}
                </p>
            </div>
        </BorderedContainer>

        <div class="flex grid grid-cols-1 flex-row flex-wrap gap-6 md:grid-cols-2 lg:grid-cols-3 lg:px-12">
            <borderedContainer
                v-for="gameLobby in gameLobbies.data"
                :key="gameLobby.id"
                :style="{ 'background-color': `${gameLobby.theme_color}` }"
            >
                <div class="h-full max-w-3xl rounded-lg bg-white p-6">
                    <div class="aspect-w-16 aspect-h-9 mb-4">
                        <img
                            class="rounded-lg"
                            :src="gameLobby.image_url"
                            :alt="`${game.name} - ${gameLobby.name} Art`"
                        />
                    </div>
                    <div class="mb-4 flex flex-row justify-between">
                        <h2 class="font-grota text-xl font-extrabold uppercase text-wgh-gray-6">
                            {{ gameLobby.name }}
                        </h2>
                        <div class="text-bold font-grota text-base text-wgh-gray-6">
                            <span>{{ gameLobby.base_entrance_fee }} {{ gameLobby.asset.symbol }}</span>
                        </div>
                    </div>
                    <button
                        class="mb-6 w-full uppercase disabled:cursor-not-allowed"
                        @click.prevent="startGameButtonClicked(gameLobby)"
                        :disabled="
                            settings.isThereActiveLobbySession() &&
                            gameLobby.id !== settings.getActiveGameLobbySession().id
                        "
                    >
                        <ButtonShape type="red">
                            <div class="w-full content-center">
                                <span
                                    class="w-full"
                                    v-if="
                                        settings.isThereActiveLobbySession() &&
                                        gameLobby.id === settings.getActiveGameLobbySession().id
                                    "
                                    >Rejoin Lobby</span
                                >
                                <span v-else class="w-full">Start Playing</span>
                            </div>
                        </ButtonShape>
                    </button>

                    <div>
                        <p class="mb-2 font-inter text-sm font-semibold text-wgh-gray-6">Game Rules</p>
                        <div class="list-inside list-disc font-inter text-sm font-normal text-wgh-gray-4">
                            {{ gameLobby?.rules }}
                        </div>
                    </div>
                </div>
            </borderedContainer>
        </div>
    </div>
</template>
