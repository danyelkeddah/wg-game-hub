<script setup>
import BorderedContainer from '@/Shared/BorderedContainer';
import KiteArrow from '@/Shared/SVG/KiteArrow';
import ChatMessage from '@/Shared/Chat/ChatMessage';
import { onBeforeUnmount, onMounted, defineProps, reactive, ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import LeaderBoardModal from '@/Shared/Modals/LeaderBoardModal';
import dayjs from 'dayjs';
import LogoRed from '@/Shared/SVG/LogoRed';
import { useCurrentUser } from '@/Composables/useCurrentUser';
import GameLobby from '@/Models/GameLobby';

let props = defineProps({
    gameLobby: Object,
    config: Object,
});

let chatBox = ref();

let currentUser = useCurrentUser();
let gameLobby = reactive(new GameLobby(props.gameLobby.data));

let chatMessages = reactive([]);
let chatMessageInput = ref('');
let relativeTime = require('dayjs/plugin/relativeTime');
let duration = require('dayjs/plugin/duration');

onMounted(() => {
    dayjs.extend(relativeTime);
    dayjs.extend(duration);
    gameLobby.startCountDownTimer();
    if (currentUser) {
        window.echo
            .join(`game-lobby.${gameLobby.id}`)
            .error(channelError)
            .listen(GameLobby.socketEvents.chatMessage, channelNewChatMessage)
            .listen(GameLobby.socketEvents.userJoined, channelUserJoined)
            .listen(GameLobby.socketEvents.userLeft, channelUserLeft)
            .listen(GameLobby.socketEvents.status.processingResults, channelProcessingResults)
            .listen(GameLobby.socketEvents.status.resultsProcessed, channelResultsProccessed);
    }
});

onBeforeUnmount(() => {
    gameLobby.killCountDownTimer();
    if (currentUser) {
        window.echo.leave(`game-lobby.${gameLobby.id}`);
    }
});

watch(
    chatMessages,
    () => {
        chatBox.value.scrollTop = chatBox.value.scrollHeight;
    },
    {
        flush: 'post',
    }
);

function channelError(error) {
    console.error('channel error: ', error);
}

function sendChatMessage() {
    if (chatMessageInput.value.length <= 0) {
        return;
    }
    Inertia.post(
        `/chat-rooms/${gameLobby.id}/message`,
        {
            message: chatMessageInput.value,
        },
        {
            preserveScroll: true,
        }
    );
    chatMessageInput.value = '';
}

function channelNewChatMessage(message) {
    chatMessages.push(message);
}

function channelUserJoined(payload) {
    gameLobby.addUser(payload.user);
}

function channelUserLeft(payload) {
    gameLobby.removeUser(payload.user);
}

function channelProcessingResults(payload) {}

function channelResultsProccessed(payload) {
    gameLobby.resultsAreProccessed();
}
</script>
<script>
import BaseLayout from '@/Layouts/_BaseLayout';
import GameLobbyLayout from '@/Layouts/GameLobbyLayout';

export default {
    layout: [BaseLayout, GameLobbyLayout],
};
</script>
<template>
    <LeaderBoardModal :is-open="gameLobby.areResultsProcessed" :game-lobby="gameLobby" />
    <div class="mx-auto grid w-full max-w-7xl gap-y-6 p-2 pt-12 pb-24 lg:grid-cols-12 lg:gap-x-6">
        <div class="col-span-12 flex inline-flex lg:col-span-5">
            <Link method="delete" as="button" type="button" :href="`/game-lobbies/${gameLobby.id}/leave`" replace>
                <div
                    class="cursor-pointer rounded-lg border-b-6 border-wgh-red-3 bg-wgh-red-3 transition-all duration-100 active:mt-1.5 active:border-b-0"
                >
                    <div
                        class="flex flex-row space-x-2.5 rounded-lg border-3 border-wgh-red-3 bg-wgh-red-2 px-4 py-2 text-center font-grota text-white text-white outline-none transition-all duration-100 hover:bg-wgh-red-1 active:border-wgh-red-4 active:bg-wgh-red-3"
                    >
                        Leave Lobby
                    </div>
                </div>
            </Link>
        </div>

        <div class="col-span-12 lg:col-span-7">
            <LogoRed class="h-14" />
        </div>
    </div>
    <div class="mx-auto grid w-full max-w-7xl gap-y-6 p-2 lg:grid-cols-12 lg:gap-x-6">
        <div class="col-span-12 lg:col-span-4">
            <p class="invisible mb-2 font-grota text-lg font-extrabold uppercase text-white">Time remaining</p>
            <BorderedContainer class="bg-wgh-purple-3">
                <div class="rounded-lg bg-white p-4">
                    <div class="flex flex-row justify-between rounded bg-wgh-gray-0.5 px-4 py-3">
                        <p class="font-grota text-sm font-normal uppercase text-wgh-gray-6">
                            {{ gameLobby.game.name }}
                        </p>
                        <p class="font-grota text-sm font-semibold uppercase text-wgh-gray-6">RESTRICTED GAME</p>
                    </div>
                    <div class="w-full py-16">
                        <img class="mx-auto w-40" :src="config.game_lobby_loading_gif" alt="Loading.." />
                        <p class="text-center font-inter text-xs font-normal uppercase text-wgh-gray-2">WAITING TIME</p>
                        <p
                            v-if="!gameLobby.timeToStartAsString"
                            class="mt-2 text-center font-grota text-3xl font-extrabold text-wgh-red-2"
                        >
                            Loading...
                        </p>
                        <p
                            v-if="gameLobby.timeToStartAsString"
                            class="mt-2 text-center font-grota text-3xl font-extrabold text-wgh-red-2"
                        >
                            {{ gameLobby.timeToStartAsString }}
                        </p>
                    </div>
                </div>
            </BorderedContainer>
        </div>
        <div class="relative col-span-12 flex h-96 grow flex-col lg:col-span-4 lg:h-auto">
            <p class="mb-2 font-grota text-lg font-extrabold uppercase text-white">Chat</p>
            <div class="relative h-full w-full w-full">
                <BorderedContainer class="absolute inset-0 bg-wgh-purple-3">
                    <div class="flex h-full h-full w-full w-full grow flex-col justify-between rounded-lg bg-white p-4">
                        <div
                            id="chat-messages"
                            class="flex flex-col space-y-2 overflow-y-scroll scroll-smooth px-2 pb-2"
                            ref="chatBox"
                        >
                            <ChatMessage
                                v-for="chatMessage in chatMessages"
                                :from-me="chatMessage.sender.id === currentUser.id"
                                :user-image-url="chatMessage.sender.image_url"
                                :time="chatMessage.created_at_human_readable"
                                :username="chatMessage.sender.username"
                                :message="chatMessage.message.message"
                            />
                        </div>
                        <div class="flex w-full flex-row space-x-2 rounded-md border-2 border-wgh-gray-1 p-px">
                            <input
                                type="text"
                                class="shrink grow p-2 outline-none ring-0"
                                placeholder="Type your message here"
                                v-model="chatMessageInput"
                                @keyup.enter="sendChatMessage"
                            />
                            <button
                                :disabled="chatMessageInput.length <= 0"
                                @click.prevent="sendChatMessage"
                                class="rounded-md bg-wgh-purple-2 py-2 px-4 disabled:cursor-no-drop"
                            >
                                <KiteArrow class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
                </BorderedContainer>
            </div>
        </div>
        <div class="relative col-span-12 flex h-96 grow flex-col lg:col-span-4 lg:h-auto">
            <p class="mb-2 font-grota text-lg font-extrabold uppercase text-white">
                Players ({{ gameLobby.users.length }} / {{ gameLobby.max_players }})
            </p>
            <div class="relative h-full w-full w-full">
                <BorderedContainer class="absolute inset-0 bg-wgh-purple-3">
                    <div
                        id="players-list"
                        class="divider-wgh-gray-0.5 flex flex h-full w-full grow flex-col flex-col justify-between divide-y overflow-y-scroll rounded-lg bg-white p-2 px-2 pb-2"
                    >
                        <div class="flex flex-row justify-between py-2" v-for="user in gameLobby.users">
                            <div class="flex flex-row items-center space-x-4">
                                <img class="h-8 w-8 rounded-full" :src="user.image_url" />
                                <p class="font-grota text-sm font-bold uppercase text-wgh-gray-6">
                                    {{ user.full_name }}
                                </p>
                            </div>
                            <div class="flex flex-row items-center">
                                <p class="font-grota text-sm font-bold uppercase text-wgh-yellow-3">3x Winner</p>
                            </div>
                        </div>
                    </div>
                </BorderedContainer>
            </div>
        </div>
    </div>
</template>
<style scoped>
div::-webkit-scrollbar {
    display: none;
    scrollbar-width: none;
}
</style>
