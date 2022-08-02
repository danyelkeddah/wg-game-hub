<script setup>
import ExclamationCircleIcon from '@/Shared/SVG/ExclamationCircleIcon';
import ButtonShape from '@/Shared/ButtonShape';
import BananoLogo from '@/Shared/SVG/BananoLogo';
import BorderedContainer from '@/Shared/BorderedContainer';
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <BorderedContainer class="bg-wgh-gray-1.5">
        <div class="flex flex-col items-center rounded-lg bg-white p-6">
            <ExclamationCircleIcon class="mb-4 h-10 w-10" />
            <p
                class="font mt-1 font-grota text-lg font-extrabold text-wgh-gray-6"
            >
                My Wallet
            </p>
            <p
                class="mb-4 text-center font-inter text-sm font-normal text-wgh-gray-4"
            >
                In order to create a Banano wallet you need to create an
                account.
            </p>
            <button>
                <Link href="/register">
                    <ButtonShape type="gray" class="mb-5 font-bold"
                        ><span>Create an Account</span></ButtonShape
                    >
                </Link>
            </button>
            <div class="flex flex-row space-x-4">
                <p
                    class="font-inter text-xs font-normal uppercase text-[#909399]"
                >
                    Powered By
                </p>

                <BananoLogo />
            </div>
        </div>
    </BorderedContainer>
</template>
