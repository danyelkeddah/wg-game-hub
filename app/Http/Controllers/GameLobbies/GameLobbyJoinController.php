<?php

namespace App\Http\Controllers\GameLobbies;

use App\Actions\Games\GameLobbies\AddUserToGameLobbyAction;
use App\Enums\Reactions\AddUserToGameLobbyReaction;
use App\Http\Controllers\Controller;
use App\Models\GameLobby;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class GameLobbyJoinController extends Controller
{
    public function __invoke(Request $request, GameLobby $gameLobby, AddUserToGameLobbyAction $addUserToGameLobbyAction)
    {
        $this->authorize('join', $gameLobby);
        /** @var \App\Enums\Reactions\AddUserToGameLobbyReaction|GameLobby $reaction */
        $reaction = $addUserToGameLobbyAction->execute(user: Auth::user(), gameLobby: $gameLobby);

        if ($reaction instanceof AddUserToGameLobbyReaction) {
            session()->flash('error', $reaction->label());
            return Redirect::route('games.show', [
                'game' => $gameLobby->game_id,
            ]);
        }

        return Redirect::route('game-lobbies.show', [
            'gameLobby' => $gameLobby,
        ]);
    }
}
