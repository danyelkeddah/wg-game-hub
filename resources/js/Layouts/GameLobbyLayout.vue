<script setup>
import Footer from '@/Shared/Footer/Footer';

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
