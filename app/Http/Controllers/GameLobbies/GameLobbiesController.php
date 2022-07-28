<?php

namespace App\Http\Controllers\GameLobbies;

use App\Enums\GameLobbyStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameLobbyResource;
use App\Models\GameLobby;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class GameLobbiesController extends Controller
{
    public function show(GameLobby $gameLobby)
    {
        $this->authorize('view', $gameLobby);

        $gameLobby->load(
            'game:id,name,description',
            'users:id,name,image,username',
        );

        if ($gameLobby->status === GameLobbyStatus::ResultsProcessed) {
            // load the top 6 including the current user.
            $gameLobby->load('scores');
        }

        return Inertia::render('Games/Lobbies/Show', [
            'gameLobby' => new GameLobbyResource($gameLobby),
        ]);
    }
}
