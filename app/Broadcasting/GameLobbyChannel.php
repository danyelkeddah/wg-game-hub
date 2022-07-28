<?php

namespace App\Broadcasting;

use App\Models\ChatRoom;
use App\Models\GameLobby;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GameLobbyChannel
{
    public function __construct()
    {
        //
    }

    public function join(User $user, GameLobby $gameLobby)
    {
        $userJoinedTheGameLobby = $gameLobby
            ->users()
            ->where('user_id', $user->id)
            ->exists();

        if ($userJoinedTheGameLobby) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'full_name' => $user->full_name,
                'username' => $user->username,
                'image_url' => $user->image_url,
            ];
        }

        return false;
    }
}
