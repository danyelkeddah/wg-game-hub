<?php

namespace App\Policies;

use App\Enums\ChatRoomType;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatRoomPolicy
{
    use HandlesAuthorization;

    public function message(?User $user, ChatRoom $chatRoom): bool
    {
        if ($chatRoom->type === ChatRoomType::Main) {
            return true;
        }
        return $chatRoom
            ->users()
            ->where('users.id', $user->id)
            ->exists();
    }
}
