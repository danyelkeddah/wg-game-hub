<?php

namespace App\Http\Controllers\API\Games;

use App\Http\Controllers\Controller;
use App\Http\QueryPipelines\GameLobbyPipeline\GameLobbyPipeline;
use App\Http\Resources\GameLobbyResource;
use App\Models\Game;
use App\Models\GameLobby;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameLobbiesController extends Controller
{
    public function index(Request $request, Game $game)
    {
        $gameLobbies = GameLobbyPipeline::make(builder: $game->gameLobbies()->getQuery(), request: $request)
            ->with('asset:id,name,symbol')
            ->paginate();

        return GameLobbyResource::collection($gameLobbies);
    }

    public function show(GameLobby $gameLobby)
    {
        $gameLobby->load('game:id,name,description', 'users:id,name,image,username');

        return new GameLobbyResource(resource: $gameLobby);
    }
}
