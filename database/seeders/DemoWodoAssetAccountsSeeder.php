<?php

namespace Database\Seeders;

use App\Enums\UserAssetAccountStatus;
use App\Models\WodoAssetAccount;
use Illuminate\Database\Seeder;
use Str;

class DemoWodoAssetAccountsSeeder extends Seeder
{
    public function run()
    {
        WodoAssetAccount::insert($this->wodoAssetsAccounts()->toArray());
    }

    public function wodoAssetsAccounts()
    {
        return collect([
            [
                'id' => Str::uuid(),
                'asset_id' => '47957a18-8384-4346-9787-52b27e6d3bd5',
                'balance' => 1_000_000,
                'status' => UserAssetAccountStatus::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'asset_id' => '6fb70125-068b-457a-a43e-ef92f0907233',
                'balance' => 1_000_000,
                'status' => UserAssetAccountStatus::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'asset_id' => '7fef68a0-6efa-4681-9bbf-0848bee571ba',
                'balance' => 1_000_000,
                'status' => UserAssetAccountStatus::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'asset_id' => '165aa799-bf3e-432f-bf20-32fac4ca7eb9',
                'balance' => 1_000_000,
                'status' => UserAssetAccountStatus::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
