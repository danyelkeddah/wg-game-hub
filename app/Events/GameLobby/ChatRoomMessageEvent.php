<?php

namespace App\Events\GameLobby;

use App\Enums\ChatRoomType;
use App\Models\ChatRoom;
use App\Models\ChatRoomMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatRoomMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ChatRoom $chatRoom,
        public User $sender,
        public ChatRoomMessage $chatRoomMessage,
    ) {
    }

    public function broadcastOn(): PresenceChannel|array
    {
        if ($this->chatRoom->type === ChatRoomType::GameLobby) {
            return [
                new PresenceChannel('chat-rooms.' . $this->chatRoom->id),
                new PresenceChannel('game-lobby.' . $this->chatRoom->id),
            ];
        }
        return new PresenceChannel('chat-rooms.' . $this->chatRoom->id);
    }

    public function broadcastAs(): string
    {
        return 'chat.message';
    }

    public function broadcastWith(): array
    {
        return [
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
                'last_name' => $this->sender->last_name,
                'full_name' => $this->sender->full_name,
                'username' => $this->sender->username,
                'image_url' => $this->sender->image_url,
            ],
            'message' => [
                'message' => $this->chatRoomMessage->message,
                'created_at_human_readable' => $this->chatRoomMessage->created_at->toDateTimeString(),
            ],
        ];
    }
}
