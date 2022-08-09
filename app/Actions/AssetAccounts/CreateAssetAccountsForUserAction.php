<?php

namespace App\Actions\AssetAccounts;

use App\Enums\UserAssetAccountStatus;
use App\Models\Asset;
use App\Models\User;

class CreateAssetAccountsForUserAction
{
    public function execute(User $user): void
    {
        $assets = Asset::get(['id']);
        $user->assets()->attach($assets->pluck('id'), ['balance' => 1000, 'status' => UserAssetAccountStatus::Active]);
    }
}
