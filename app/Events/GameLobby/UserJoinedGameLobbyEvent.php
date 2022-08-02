<?php

namespace App\Events\GameLobby;

use App\Models\GameLobby;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserJoinedGameLobbyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public GameLobby $gameLobby, public User $user, public int $entranceFee)
    {
    }

    public function broadcastOn(): Channel
    {
        return new PresenceChannel('game-lobby.' . $this->gameLobby->id);
    }

    public function broadcastAs(): string
    {
        return 'user.joined';
    }

    public function broadcastWith(): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'last_name' => $this->user->last_name,
                'full_name' => $this->user->full_name,
                'username' => $this->user->username,
                'image_url' => $this->user->image_url,
                'entrance_fee' => $this->entranceFee,
            ],
        ];
    }
}
