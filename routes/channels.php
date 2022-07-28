<?php

use App\Broadcasting\ChatRoomChannel;
use App\Broadcasting\GameLobbyChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat-rooms.{chatRoom}', ChatRoomChannel::class);
Broadcast::channel('game-lobby.{gameLobby}', GameLobbyChannel::class);
