<?php

namespace App\Broadcasting;

use App\Models\ChatRoom;
use App\Models\User;

class ChatRoomChannel
{
    public function __construct()
    {
        //
    }

    public function join(User $user, ChatRoom $chatRoom)
    {
        $userJoinedTheRoom = $chatRoom
            ->users()
            ->where('user_id', $user->id)
            ->exists();

        if ($userJoinedTheRoom) {
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
