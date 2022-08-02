<?php

namespace Database\Factories;

use App\Enums\GameLobbyStatus;
use App\Enums\GameLobbyType;
use App\Models\Asset;
use App\Models\Game;
use App\Models\GameLobby;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GameLobbyFactory extends Factory
{
    protected $model = GameLobby::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(337, 110),
            'theme_color' => $this->faker->safeHexColor(),
            'type' => $this->faker->randomElement(GameLobbyType::cases()),
            'status' => $this->faker->randomElement(GameLobbyStatus::cases()),
            'rules' => $this->faker->paragraph(),
            'base_entrance_fee' => rand(5, 10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'game_id' => Game::factory(),
            'min_players' => rand(1, 2),
            'max_players' => ($mp = rand(4, 5)),
            'available_spots' => $mp,
            'scheduled_at' => now()->addHours(rand(5, 200)),
        ];
    }

    public function scheduledInPast()
    {
        return $this->state(function (array $attributes) {
            $d = rand(5, 100);
            return [
                'scheduled_at' => now()->subDays($d),
            ];
        });
    }
}
