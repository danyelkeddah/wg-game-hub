<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import BorderedContainer from '@/Shared/BorderedContainer';
import { Link } from '@inertiajs/inertia-vue3';
import { useCurrentUser } from '@/Composables/useCurrentUser';

let currentUser = useCurrentUser();
</script>
<template>
    <BorderedContainer
        v-if="currentUser?.current_lobby_session"
        class="mb-8 flex flex-col space-y-6 border-wgh-red-3 bg-wgh-red-2 p-6 md:flex-row md:space-x-6 md:space-y-0"
    >
        <div class="rounded-lg p-4">
            <p class="font-grota text-2xl font-extrabold text-white">
                You have an active session for "{{ currentUser.current_lobby_session.name }}",
                <Link :href="`/game-lobbies/${currentUser.current_lobby_session.id}`">
                    <span class="underline"> Click here </span></Link
                >
                to go back to lobby
            </p>
        </div>
    </BorderedContainer>
</template>
