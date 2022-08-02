<?php

namespace Database\Seeders;

use App\Enums\GameStatus;
use App\Models\Game;
use Illuminate\Database\Seeder;
use Str;

class DemoGamesSeeder extends Seeder
{
    public function run()
    {
        Game::insert($this->games()->toArray());
    }

    protected function games()
    {
        return collect([
            [
                'id' => '753501ba-a9fa-437b-8b44-8d8ca42f18ab',
                'name' => 'Agar.io',
                'description' =>
                    'Agar.io is a Massively-multiplayer top-down strategy browser game. In Agar.io, the player manipulates a circular cell using the mouse and keyboard buttons.',
                'status' => GameStatus::Online,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2934ceee-e195-4cd0-ae6a-d2098c810917',
                'name' => 'Slither.io',
                'description' =>
                    'Slither.io is a massively multiplayer browser game where players control a snake-like avatar, which consumes multicolored pellets from other players, and ones that naturally spawn on the map in the game to grow in size. The objective of the game is to grow the longest snake in the server.',
                'status' => GameStatus::Online,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '1db03dcf-f131-4a8d-bbe4-c8c8d2d5198b',
                'name' => 'Hole.io',
                'description' =>
                    'Absorb everyone into your black hole in the new game ',
                'status' => GameStatus::Online,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
