<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ChatRoomMessage */
class ChatRoomMessageToSocketResource extends JsonResource
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
        ];
    }
}
