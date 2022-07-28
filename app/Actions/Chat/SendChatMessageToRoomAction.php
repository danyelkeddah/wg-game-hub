<?php

namespace App\Actions\Chat;

use App\Events\GameLobby\ChatRoomMessageEvent;
use App\Models\ChatRoom;
use App\Models\ChatRoomMessage;
use Illuminate\Http\Request;

class SendChatMessageToRoomAction
{
    public function execute(Request $request, ChatRoom $chatRoom): void
    {
        $user = $request->user();
        $chatRoom->messages()->save(
            $message = new ChatRoomMessage([
                'user_id' => $user->id,
                'message' => $request->message,
                'created_at' => now(),
            ]),
        );

        broadcast(
            new ChatRoomMessageEvent(
                chatRoom: $chatRoom,
                sender: $user,
                chatRoomMessage: $message,
            ),
        );
    }
}
