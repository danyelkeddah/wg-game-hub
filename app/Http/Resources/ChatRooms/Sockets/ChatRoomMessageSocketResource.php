<?php

namespace App\Http\Resources\ChatRooms\Sockets;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ChatRoomMessage */
class ChatRoomMessageSocketResource extends JsonResource
{
    public function __construct($resource)
    {
        self::withoutWrapping();
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'message' => $this->message,
            'created_at_human_readable' => $this->created_at->toDateTimeString(),
        ];
    }
}
