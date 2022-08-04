<?php

namespace App\Http\Controllers\API\Games;

use App\Actions\Games\GameLobbies\AddUserToGameLobbyAction;
use App\Enums\Reactions\AddUserToGameLobbyReaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameLobbyResource;
use App\Models\GameLobby;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameLobbyJoinController extends Controller
{
    public function __invoke(Request $request, GameLobby $gameLobby, AddUserToGameLobbyAction $addUserToGameLobbyAction)
    {
        $this->authorize('join', $gameLobby);

        $reaction = $addUserToGameLobbyAction->execute(user: Auth::user(), gameLobby: $gameLobby);

        if ($reaction instanceof AddUserToGameLobbyReaction) {
            return abort(Response::HTTP_FORBIDDEN, $reaction->label());
        }

        return new GameLobbyResource(resource: $gameLobby);
    }
}
