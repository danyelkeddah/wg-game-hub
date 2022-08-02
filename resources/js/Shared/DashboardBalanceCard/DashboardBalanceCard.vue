<script setup>
import ButtonShape from '@/Shared/ButtonShape';
import DashboardBalanceCardCoin from '@/Shared/DashboardBalanceCard/DashboardBalanceCardCoin';
import BorderedContainer from '@/Shared/BorderedContainer';

let props = defineProps({
    balance: Array,
    asset_accounts: Object,
});
</script>
<template>
    <BorderedContainer class="bg-wgh-gray-1.5">
        <div class="rounded-lg bg-white p-6">
            <div class="mb-4 flex flex-col space-y-4">
                <DashboardBalanceCardCoin
                    v-for="account in props.asset_accounts"
                    :account="account"
                />
            </div>
            <div>
                <button class="w-full outline-none">
                    <ButtonShape type="gray">
                        <span class="w-full text-center font-bold uppercase"
                            >Top UP</span
                        >
                    </ButtonShape>
                </button>
            </div>
        </div>
    </BorderedContainer>
</template>
