<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;
use Str;

class DemoAssetsSeeder extends Seeder
{
    public function run()
    {
        Asset::insert($this->assets()->toArray());
    }

    protected function assets()
    {
        return collect([
            [
                'id' => '47957a18-8384-4346-9787-52b27e6d3bd5',
                'name' => 'Banano',
                'description' => 'Banano Coin',
                'symbol' => 'BAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '6fb70125-068b-457a-a43e-ef92f0907233',
                'name' => 'Binance Coin',
                'description' => 'Binance Coin',
                'symbol' => 'BNB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '7fef68a0-6efa-4681-9bbf-0848bee571ba',
                'name' => 'Nano',
                'description' => 'Nano Coin',
                'symbol' => 'XNO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '165aa799-bf3e-432f-bf20-32fac4ca7eb9',
                'name' => 'Ethereum',
                'description' => 'Ethereum Coin',
                'symbol' => 'ETH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
