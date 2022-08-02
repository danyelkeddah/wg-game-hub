<?php

namespace Database\Seeders;

use App\Enums\UserAssetAccountStatus;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserAssetAccountsSeeder extends Seeder
{
    public function run()
    {
        $assetAccounts = Asset::all(['id']);
        /** @var User $user */
        foreach (User::cursor() as $user) {
            $user->assets()->attach($assetAccounts, [
                'balance' => 1_000,
                'status' => UserAssetAccountStatus::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
