<script setup>
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import { defineProps, reactive } from 'vue';
import ButtonShape from '@/Shared/ButtonShape';
import { useCurrentUser } from '@/Composables/useCurrentUser';

let currentUser = useCurrentUser();
let props = defineProps({
    isOpen: Boolean,
    gameLobby: Object,
});

let players = _.merge(
    _.keyBy(props.gameLobby.users, 'id'),
    _.keyBy(props.gameLobby.scores, 'user_id')
);

let orderedPlayers = _.flatten(
    _.merge(
        _.partition(players, (player) => {
            return player.rank % 2 === 0;
        })
    )
);
let currentUserScoreRecord = _.find(orderedPlayers, ['id', currentUser.id]);
</script>

<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-10">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                />
            </TransitionChild>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <div class="w-full max-w-lg">
                            <!--                            <LeaderBoardStars-->
                            <!--                                class="absolute top-1/2 left-1/2 isolate -z-30 -mt-52 -translate-x-1/2 -translate-y-1/2 transform"-->
                            <!--                            />-->

                            <div>
                                <!--                                sm:my-8 border-t-4 rounded-2xl-->

                                <div class="relative px-5">
                                    <div
                                        class="h-3 w-full rounded-2xl rounded-tl-full rounded-tr-full border-r-4 border-l-4 border-wgh-red-2 bg-white"
                                    ></div>
                                    <svg
                                        class="absolute top-1/2 left-1/2 -z-40 -z-20 -mt-[14rem] w-full -translate-x-1/2 -translate-y-1/2 transform lg:-mt-[14.5rem] lg:w-[107.5%]"
                                        width="585"
                                        height="273"
                                        viewBox="0 0 585 273"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_1_1330)">
                                            <path
                                                d="M327.866 22.6255L291.718 202.151L310.376 38.6659L327.866 22.6255Z"
                                                fill="url(#paint0_linear_1_1330)"
                                            />
                                            <path
                                                d="M273.06 38.6659L291.718 202.151L255.615 22.6255L273.06 38.6659Z"
                                                fill="url(#paint1_linear_1_1330)"
                                            />
                                            <path
                                                d="M291.717 51.344V202.151L267.556 63.2284L291.717 51.344Z"
                                                fill="url(#paint2_linear_1_1330)"
                                            />
                                            <path
                                                d="M315.879 63.2284L291.718 202.151V51.344L315.879 63.2284Z"
                                                fill="url(#paint3_linear_1_1330)"
                                            />
                                            <path
                                                d="M291.718 0.467957L302.819 19.4268L327.866 22.6256L310.375 38.6659L315.879 63.2283L291.718 51.344L267.557 63.2283L273.06 38.6659L255.615 22.6256L280.64 19.4268L291.718 0.467957Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M267.557 154.287L271.334 160.731L279.871 161.828L273.9 167.291L275.789 175.674L267.557 171.635L259.324 175.674L261.189 167.291L255.242 161.828L263.779 160.731L267.557 154.287Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M459.812 60.7852L347.634 212.293L443.976 75.1678L459.812 60.7852Z"
                                                fill="url(#paint4_linear_1_1330)"
                                            />
                                            <path
                                                d="M408.69 73.9537L347.634 212.293L390.452 58.0301L408.69 73.9537Z"
                                                fill="url(#paint5_linear_1_1330)"
                                            />
                                            <path
                                                d="M449.923 97.4654L347.634 212.293L427.114 86.2115L449.923 97.4654Z"
                                                fill="url(#paint6_linear_1_1330)"
                                            />
                                            <path
                                                d="M405.168 96.298L347.634 212.293L408.69 73.9537L405.168 96.298Z"
                                                fill="url(#paint7_linear_1_1330)"
                                            />
                                            <path
                                                d="M427.114 86.2115L347.634 212.293L405.168 96.2981L427.114 86.2115Z"
                                                fill="url(#paint8_linear_1_1330)"
                                            />
                                            <path
                                                d="M424.339 37.8571L436.023 56.8159L459.811 60.7852L443.975 75.1678L449.923 97.4654L427.114 86.2115L405.168 96.2981L408.69 73.9537L390.452 58.0301L414.684 55.9287L424.339 37.8571Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M120.289 63.0699L232.468 214.578L136.125 77.4525L120.289 63.0699Z"
                                                fill="url(#paint9_linear_1_1330)"
                                            />
                                            <path
                                                d="M171.411 76.2384L232.468 214.578L189.649 60.3148L171.411 76.2384Z"
                                                fill="url(#paint10_linear_1_1330)"
                                            />
                                            <path
                                                d="M130.179 99.7505L232.468 214.578L152.987 88.4963L130.179 99.7505Z"
                                                fill="url(#paint11_linear_1_1330)"
                                            />
                                            <path
                                                d="M174.933 98.6062L232.468 214.578L171.411 76.2384L174.933 98.6062Z"
                                                fill="url(#paint12_linear_1_1330)"
                                            />
                                            <path
                                                d="M152.987 88.4963L232.468 214.578L174.933 98.6062L152.987 88.4963Z"
                                                fill="url(#paint13_linear_1_1330)"
                                            />
                                            <path
                                                d="M155.739 40.1418L144.055 59.1007L120.289 63.0699L136.125 77.4525L130.178 99.7505L152.987 88.4963L174.933 98.6062L171.411 76.2384L189.649 60.3148L165.417 58.2135L155.739 40.1418Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M86.9634 75.7376L83.4417 82.3918L76.4919 83.9095L81.0862 88.6725L79.3604 96.0973L85.9838 92.3149L92.4206 95.6537L91.511 88.1122L97.1316 82.5085L89.7852 81.9483L86.9634 75.7376Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M227.117 25.6672L223.665 32.4149L216.669 33.8391L221.333 38.9758L219.584 46.9142L226.3 42.8983L232.783 46.494L231.734 38.5322L237.122 32.8585L229.961 32.1113L227.117 25.6672Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M187.26 169.867L184.695 174.023L179.494 174.886L182.946 178.039L181.663 182.918L186.654 180.466L191.458 182.685L190.688 177.782L194.7 174.28L189.383 173.836L187.26 169.867Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M349.719 22.1731L353.147 28.9207L360.167 30.345L355.503 35.4583L357.252 43.4201L350.536 39.4041L344.052 42.9998L345.078 35.038L339.714 29.3644L346.873 28.6173L349.719 22.1731Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M480.942 94.1428L484.371 100.89L491.391 102.314L486.726 107.428L488.475 115.39L481.759 111.374L475.275 114.97L476.302 107.007L470.938 101.334L478.097 100.587L480.942 94.1428Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                d="M332.229 163.329L334.794 167.485L340.018 168.349L336.543 171.501L337.849 176.404L332.835 173.929L328.031 176.148L328.8 171.244L324.813 167.742L330.129 167.298L332.229 163.329Z"
                                                fill="#FFE029"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M585 221.419C499.42 197.883 409.304 185.312 316.256 185.312V234.861C409.531 234.861 499.707 248.142 585 272.918L561.739 240.311L585 221.419Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M585 221.419C499.42 197.883 409.304 185.312 316.256 185.312V234.861C409.531 234.861 499.707 248.142 585 272.918L561.739 240.311L585 221.419Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M585 221.419C499.42 197.883 409.304 185.312 316.256 185.312V234.861C409.531 234.861 499.707 248.142 585 272.918L561.739 240.311L585 221.419Z"
                                                fill="#FF3815"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M0.494919 221.419C86.0756 197.883 176.191 185.312 269.239 185.312V234.861C175.964 234.861 85.7884 248.142 0.494919 272.918L23.7563 240.311L0.494919 221.419Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M0.494919 221.419C86.0756 197.883 176.191 185.312 269.239 185.312V234.861C175.964 234.861 85.7884 248.142 0.494919 272.918L23.7563 240.311L0.494919 221.419Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M0.494919 221.419C86.0756 197.883 176.191 185.312 269.239 185.312V234.861C175.964 234.861 85.7884 248.142 0.494919 272.918L23.7563 240.311L0.494919 221.419Z"
                                                fill="#FF3815"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M561.244 207.609C475.663 231.146 385.548 243.189 292.5 243.189V193.64C385.774 193.64 475.95 180.359 561.244 155.583V207.609Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M561.244 207.609C475.663 231.146 385.548 243.189 292.5 243.189V193.64C385.774 193.64 475.95 180.359 561.244 155.583V207.609Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M561.244 207.609C475.663 231.146 385.548 243.189 292.5 243.189V193.64C385.774 193.64 475.95 180.359 561.244 155.583V207.609Z"
                                                fill="#D62000"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M24.2513 207.609C109.832 231.146 199.947 243.189 292.995 243.189V193.64C199.721 193.64 109.544 180.359 24.2513 155.583V207.609Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M24.2513 207.609C109.832 231.146 199.947 243.189 292.995 243.189V193.64C199.721 193.64 109.544 180.359 24.2513 155.583V207.609Z"
                                                fill="#9E9E9E"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M24.2513 207.609C109.832 231.146 199.947 243.189 292.995 243.189V193.64C199.721 193.64 109.544 180.359 24.2513 155.583V207.609Z"
                                                fill="#D62000"
                                            />
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_1_1330"
                                                x1="291.718"
                                                y1="112.377"
                                                x2="327.866"
                                                y2="112.377"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#EDA826" />
                                                <stop
                                                    offset="0.33"
                                                    stop-color="#EFAE2C"
                                                />
                                                <stop
                                                    offset="0.77"
                                                    stop-color="#F3BF3D"
                                                />
                                                <stop
                                                    offset="1"
                                                    stop-color="#F6CB49"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_1_1330"
                                                x1="2935.12"
                                                y1="8627.28"
                                                x2="3493.97"
                                                y2="8627.28"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#EDA826" />
                                                <stop
                                                    offset="0.33"
                                                    stop-color="#EFAE2C"
                                                />
                                                <stop
                                                    offset="0.77"
                                                    stop-color="#F3BF3D"
                                                />
                                                <stop
                                                    offset="1"
                                                    stop-color="#F6CB49"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint2_linear_1_1330"
                                                x1="267.556"
                                                y1="126.76"
                                                x2="291.717"
                                                y2="126.76"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint3_linear_1_1330"
                                                x1="2458.99"
                                                y1="8208.49"
                                                x2="2709.3"
                                                y2="8208.49"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint4_linear_1_1330"
                                                x1="12001.8"
                                                y1="9261.83"
                                                x2="17397.6"
                                                y2="9261.83"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint5_linear_1_1330"
                                                x1="6690.78"
                                                y1="9335.38"
                                                x2="8289.25"
                                                y2="9335.38"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint6_linear_1_1330"
                                                x1="10974.4"
                                                y1="8428.99"
                                                x2="15460.9"
                                                y2="8428.99"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#EDA826" />
                                                <stop
                                                    offset="0.33"
                                                    stop-color="#EFAE2C"
                                                />
                                                <stop
                                                    offset="0.77"
                                                    stop-color="#F3BF3D"
                                                />
                                                <stop
                                                    offset="1"
                                                    stop-color="#F6CB49"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint7_linear_1_1330"
                                                x1="6690.78"
                                                y1="8864.01"
                                                x2="8289.25"
                                                y2="8864.01"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#EDA826" />
                                                <stop
                                                    offset="0.33"
                                                    stop-color="#EFAE2C"
                                                />
                                                <stop
                                                    offset="0.77"
                                                    stop-color="#F3BF3D"
                                                />
                                                <stop
                                                    offset="1"
                                                    stop-color="#F6CB49"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint8_linear_1_1330"
                                                x1="8604.88"
                                                y1="8428.99"
                                                x2="11313.6"
                                                y2="8428.99"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint9_linear_1_1330"
                                                x1="3034.67"
                                                y1="9264.12"
                                                x2="8430.42"
                                                y2="9264.12"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint10_linear_1_1330"
                                                x1="3096.02"
                                                y1="9337.67"
                                                x2="4694.47"
                                                y2="9337.67"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint11_linear_1_1330"
                                                x1="3221.36"
                                                y1="8431.28"
                                                x2="7707.78"
                                                y2="8431.28"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#EDA826" />
                                                <stop
                                                    offset="0.33"
                                                    stop-color="#EFAE2C"
                                                />
                                                <stop
                                                    offset="0.77"
                                                    stop-color="#F3BF3D"
                                                />
                                                <stop
                                                    offset="1"
                                                    stop-color="#F6CB49"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint12_linear_1_1330"
                                                x1="3096.02"
                                                y1="8866.3"
                                                x2="4694.47"
                                                y2="8866.3"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#EDA826" />
                                                <stop
                                                    offset="0.33"
                                                    stop-color="#EFAE2C"
                                                />
                                                <stop
                                                    offset="0.77"
                                                    stop-color="#F3BF3D"
                                                />
                                                <stop
                                                    offset="1"
                                                    stop-color="#F6CB49"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint13_linear_1_1330"
                                                x1="3332.21"
                                                y1="8431.28"
                                                x2="6040.91"
                                                y2="8431.28"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#F2BA38" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#EDA826"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_1_1330">
                                                <rect
                                                    width="585"
                                                    height="273"
                                                    fill="white"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <DialogPanel
                                        class="relative transform rounded-2xl border-r-4 border-l-4 border-b-10 border-wgh-red-2 bg-white px-4 pt-14 pt-5 pb-4 text-left shadow-xl transition-all sm:w-full sm:p-6 sm:pt-14"
                                    >
                                        <svg
                                            class="fixed top-1/2 left-1/2 z-40 -z-30 -mt-52 w-[110%] -translate-x-1/2 -translate-y-1/2 transform"
                                            width="543"
                                            height="89"
                                            viewBox="0 0 543 89"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M543 36.436C456.542 12.685 365.502 0 271.5 0V50C365.731 50 456.832 63.402 543 88.404V36.436Z"
                                                fill="#FF3815"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M0.5 36.436C86.958 12.685 177.998 0 272 0V50C177.769 50 86.668 63.402 0.5 88.404V36.436Z"
                                                fill="#FF3815"
                                            />
                                        </svg>

                                        <div class="flex flex-col">
                                            <div
                                                class="mx-auto mb-10 flex w-full flex-row items-stretch space-x-4"
                                            >
                                                <div
                                                    class="flex flex-1 flex-col items-center"
                                                    v-for="player in orderedPlayers"
                                                >
                                                    <span
                                                        class="mb-2 font-grota text-xs font-bold text-wgh-gray-4"
                                                        >{{ player.rank }}</span
                                                    >
                                                    <img
                                                        :src="player.image_url"
                                                        :alt="player.name"
                                                        class="mb-2 h-16 w-16 rounded-full"
                                                    />
                                                    <span
                                                        class="text-center font-grota text-base font-bold text-wgh-gray-6"
                                                        >{{
                                                            player.score
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-center font-inter text-sm font-normal text-wgh-gray-6"
                                                        >{{ player.name }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="mb-6">
                                                <p
                                                    class="mb-2 text-center font-grota text-lg font-extrabold text-wgh-gray-6"
                                                >
                                                    You were so close!
                                                </p>
                                                <p
                                                    class="text-center font-inter text-base font-normal text-wgh-gray-6"
                                                >
                                                    You we’re #
                                                    {{
                                                        currentUserScoreRecord.rank
                                                    }}, next time try a bit
                                                    harder.
                                                </p>
                                            </div>
                                            <div
                                                class="flex flex-row justify-center space-x-4"
                                            >
                                                <ButtonShape
                                                    type="gray"
                                                    class="cursor-pointer uppercase"
                                                    >Play Again</ButtonShape
                                                >
                                                <ButtonShape
                                                    type="red"
                                                    class="cursor-pointer uppercase"
                                                    >CONTINUE</ButtonShape
                                                >
                                            </div>
                                        </div>
                                    </DialogPanel>
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
