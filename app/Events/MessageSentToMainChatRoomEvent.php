<?php

namespace App\Events;

use App\Http\Resources\ChatRoomMessageToSocketResource;
use App\Http\Resources\ChatRooms\Sockets\ChatRoomMessageSenderSocketResource;
use App\Models\ChatRoomMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSentToMainChatRoomEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public User $sender, public ChatRoomMessage $chatRoomMessage)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('chat-rooms.main');
    }

    public function broadcastAs(): string
    {
        return 'message';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => ChatRoomMessageToSocketResource::make($this->chatRoomMessage),
            'sender' => ChatRoomMessageSenderSocketResource::make($this->sender),
        ];
    }
}
