<?php

namespace App\Console\DevCommands;

use App\Enums\UserAssetAccountStatus;
use App\Models\Achievement;
use App\Models\Asset;
use App\Models\UserAssetAccount;
use App\Models\ChatRoom;
use App\Models\Game;
use App\Models\GameLobby;
use App\Models\User;
use App\Models\WodoAssetAccount;
use Database\Factories\AchievementFactory;
use Database\Factories\UserFactory;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class WodoGamehubDemoSeedCommand extends Command
{
    protected $signature = 'wodo:gamehub-demo-seed';

    protected $description = 'Clean and seed the database with demo data';

    public function handle()
    {
        $assetIds = $this->assets()
            ->pluck(['id'])
            ->map(function ($uuid) {
                return [
                    'asset_id' => $uuid,
                ];
            })
            ->toArray();

        $this->cleanDatabase();
        $this->createAssets();
        $this->createWodoAssetAccounts();

        $this->info('Creating Games and Game lobbyes');
        Game::factory()
            ->count(20)
            ->has(Achievement::factory()->count(8), 'achievements')
            ->has(
                GameLobby::factory()
                    ->count(10)
                    ->state(new Sequence(...$assetIds))
                    ->has(
                        ChatRoom::factory()
                            ->count(1)
                            ->state(function (
                                array $attributes,
                                GameLobby $gameLobby,
                            ) {
                                return ['id' => $gameLobby->id];
                            }),
                    ),
            )
            ->create();

        $this->info('Creating users and asset accounts');
        //        dd(Asset::all());
        $users = User::factory()
            ->count(20)
            ->hasAttached(
                Asset::all(),
                [
                    'balance' => rand(100, 1000),
                    'status' => UserAssetAccountStatus::Active,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'assets',
            )
            ->create();

        $this->table(
            ['id', 'email'],
            $users->random(2)->map->only('id', 'email'),
        );
    }

    protected function createWodoAssetAccounts()
    {
        $this->info('Creating wodo asset accounts');
        WodoAssetAccount::insert($this->wodoAssets()->toArray());
    }

    protected function createAssets()
    {
        $this->info('Creating assets!');
        Asset::insert($this->assets()->toArray());
    }

    protected function cleanDatabase()
    {
        $this->info('Clearing database!');
        $this->call('migrate:fresh');
    }

    protected function assets(): Collection
    {
        return collect([
            [
                'id' => 'd24aff3b-2cfc-477d-ab64-685259a77781',
                'name' => 'Banano',
                'description' => 'Banano coin',
                'symbol' => 'BAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'dd93d080-2ab0-4c1b-b184-b2b97b7eb838',
                'name' => 'Bitcoin',
                'description' => 'Bitcoin',
                'symbol' => 'BTC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'c473770e-fc45-46e5-af52-68940837db90',
                'name' => 'Ripple',
                'description' => 'Ripple Coin',
                'symbol' => 'XRP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'eb804f41-9369-420a-8d7d-aa78d32a2300',
                'name' => 'Ethereum',
                'description' => 'Ethereum Coin',
                'symbol' => 'ETH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    protected function wodoAssets(): Collection
    {
        return $this->assets()->map(function ($asset) {
            return [
                'id' => Str::uuid(),
                'asset_id' => $asset['id'],
                'balance' => rand(1000, 10000),
                'status' => UserAssetAccountStatus::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
    }
}
