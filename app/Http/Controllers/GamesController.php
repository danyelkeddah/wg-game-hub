<?php

namespace App\Http\Controllers;

use App\Enums\GameLobbyStatus;
use App\Http\QueryPipelines\GameLobbyPipeline\GameLobbyPipeline;
use App\Http\Resources\GameLobbyResource;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\GameLobby;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GamesController extends Controller
{
    public function show(Request $request, Game $game)
    {
        $gameLobbies = GameLobbyPipeline::make(
            builder: $game
                ->gameLobbies()
                ->whereIn('status', [
                    GameLobbyStatus::Scheduled,
                    GameLobbyStatus::InLobby,
                    GameLobbyStatus::InGame,
                ])
                ->getQuery(),
            request: $request,
        )
            ->with('asset:id,name,symbol')
            ->paginate();

        return Inertia::render('Games/Show', [
            'game' => new GameResource($game),
            'gameLobbies' => GameLobbyResource::collection($gameLobbies),
        ]);
    }
}
