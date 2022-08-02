<?php

namespace App\Http\Controllers;

use App\Enums\GameStatus;
use App\Http\Resources\ChatRoomResource;
use App\Http\Resources\GameResource;
use App\Models\ChatRoom;
use App\Models\Game;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $games = Game::where('status', GameStatus::Online)
            ->select(['id', 'name', 'description', 'image'])
            ->withCount('gameLobbies')
            ->paginate(pageName: 'games');

        return Inertia::render('Index', [
            'games' => GameResource::collection($games),
            'mainChatRoom' => ChatRoomResource::make(ChatRoom::mainChannel()->first()),
        ]);
    }
}
