<script setup>
import { onBeforeUnmount, onMounted, defineProps } from 'vue';
import { useCurrentUser } from '@/Composables/useCurrentUser';

let currentUser = useCurrentUser();

onMounted(() => {
    if (currentUser) {
        window.echo.private(`user.${currentUser.id}`);
    }
});

onBeforeUnmount(() => {
    if (currentUser) {
        window.echo.leave(`user.${currentUser.id}`);
    }
});
</script>
<template>
    <slot />
</template>
