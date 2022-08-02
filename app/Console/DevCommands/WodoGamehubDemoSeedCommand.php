<?php

namespace App\Console\DevCommands;

use App\Enums\ChatRoomType;
use App\Enums\GameLobbyStatus;
use App\Enums\GameLobbyType;
use App\Enums\GameStatus;
use App\Enums\UserAssetAccountStatus;
use App\Models\Achievement;
use App\Models\Asset;
use App\Models\UserAchievement;
use App\Models\UserAssetAccount;
use App\Models\ChatRoom;
use App\Models\Game;
use App\Models\GameLobby;
use App\Models\User;
use App\Models\UserScore;
use App\Models\WodoAssetAccount;
use Database\Factories\AchievementFactory;
use Database\Factories\GameFactory;
use Database\Factories\UserFactory;
use Database\Seeders\DemoAssetsSeeder;
use Database\Seeders\DemoGameAchievementsSeeder;
use Database\Seeders\DemoGamesSeeder;
use Database\Seeders\DemoUserAssetAccountsSeeder;
use Database\Seeders\DemoUsersSeeder;
use Database\Seeders\DemoWodoAssetAccountsSeeder;
use Database\Seeders\GeneralChatRoomSeeder;
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
        $this->call('migrate:fresh');
        $this->call(GeneralChatRoomSeeder::class);
        $this->call(DemoUsersSeeder::class);
        $this->call(DemoAssetsSeeder::class);
        $this->call(DemoGamesSeeder::class);
        // Game Achivements
        $this->call(DemoWodoAssetAccountsSeeder::class);
        $this->call(DemoUserAssetAccountsSeeder::class);
        $this->call(DemoGameAchievementsSeeder::class);

        $users = User::all();
        /** @var Game $game */
        foreach (Game::cursor() as $game) {
            GameLobby::factory()
                ->count(count: 30)
                ->for($game)
                ->state(
                    new Sequence(function ($sequance) {
                        return [
                            'asset_id' => Asset::all()->random(),
                            'status' => GameLobbyStatus::Scheduled,
                            'scheduled_at' => now()->addHours(rand(5, 200)),
                        ];
                    }),
                )
                ->has(
                    ChatRoom::factory()
                        ->count(1)
                        ->state(function (array $attributes, GameLobby $gameLobby) {
                            return [
                                'id' => $gameLobby->id,
                                'type' => ChatRoomType::GameLobby,
                            ];
                        }),
                )
                ->create();

            // Decrese the fee for each user joined this lobby
            $lobbies = GameLobby::factory()
                ->scheduledInPast()
                ->count(14)
                ->for($game)
                ->state(
                    new Sequence(function ($sequance) {
                        return [
                            'asset_id' => Asset::all()->random(),
                            'status' => GameLobbyStatus::Archived,
                        ];
                    }),
                )
                ->hasAttached($users, function ($attributes) {
                    return [
                        'entrance_fee' => $attributes['base_entrance_fee'],
                        'joined_at' => now(),
                    ];
                })
                ->has(
                    ChatRoom::factory()
                        ->count(1)
                        ->hasAttached($users)
                        ->state(function (array $attributes, GameLobby $gameLobby) {
                            return [
                                'id' => $gameLobby->id,
                                'type' => ChatRoomType::GameLobby,
                            ];
                        }),
                )
                ->create();

            $gameAchievements = Achievement::where('game_id', $game->id)->get();

            foreach ($lobbies as $lobby) {
                $users = $lobby->users;

                $scores = $users->map(function (User $user, $index) use ($lobby) {
                    return new UserScore([
                        'game_id' => $lobby->game_id,
                        'game_lobby_id' => $lobby->id,
                        'user_id' => $user->id,
                        'rank' => rand(1, 200),
                        'score' => rand(100, 3000),
                        'time_played' => rand(100, 4000),
                    ]);
                });
                $lobby->scores()->saveMany($scores);

                $achievements = $users->map(function (User $user, $index) use ($lobby, $gameAchievements) {
                    $a = $gameAchievements->pop();
                    return new UserAchievement([
                        'game_id' => $lobby->game_id,
                        'user_id' => $user->id,
                        'game_lobby_id' => $lobby->id,
                        'achievement_id' => $a->id,
                        'additional_info' => $a->description,
                        'created_at' => now()->subDays(rand(1, 100)),
                        'updated_at' => now(),
                    ]);
                });
                $lobby->usersAchievements()->saveMany($achievements);

                foreach (
                    $lobby
                        ->users()
                        ->with('assetAccounts')
                        ->cursor()
                    as $user
                ) {
                    $user->assetAccounts
                        ->where('asset_id', $lobby->asset_id)
                        ->first()
                        ->decrement('balance', $lobby->base_entrance_fee);
                }
            }
        }
    }
}
