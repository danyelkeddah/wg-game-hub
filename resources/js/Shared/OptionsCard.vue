<script setup>
import ButtonShape from '@/Shared/ButtonShape';

let props = defineProps({
    game_option_info: Object,
});
</script>
<template>
    <div
        class="m-3 mb-5 block h-96 w-11/12 justify-center rounded-2xl border-t-4 border-r-4 border-l-4 border-b-10 border-wgh-gray-1.5 bg-white p-3 sm:w-[384px]"
    >
        <div class="w-full justify-center">
            <img
                :src="game_option_info.image_url"
                class="w-full md:max-h-[10.25rem]"
            />
        </div>

        <div class="flex flex-row">
            <div
                class="w-3/6 font-grota text-sm font-extrabold uppercase text-wgh-gray-6"
            >
                {{ game_option_info.price }}
            </div>
            <div class="w-2/4"></div>
            <div class="font-grota text-xs uppercase text-wgh-gray-6">
                {{ game_option_info.price }}
            </div>
        </div>

        <div class="mt-4 mb-4 h-10">
            <button>
                <ButtonShape type="red">
                    <span>START PLAYING</span>
                </ButtonShape>
            </button>
            <!--            <WGHButton-->
            <!--                type="red"-->
            <!--                class="justify-center p-4 font-grota uppercase"-->
            <!--                >START PLAYING</WGHButton-->
            <!--            >-->
        </div>

        <div class="flex flex-col">
            <div class="font-inter text-sm uppercase text-wgh-gray-6">
                game rules
            </div>
            <div class="font-inter text-xs text-wgh-gray-6">
                {{ game_option_info.rules[0] }}
            </div>
        </div>
    </div>
</template>
