<?php

namespace App\Http\Resources\ChatRooms\Sockets;

use App\Http\Resources\AchievementResource;
use App\Http\Resources\AssetResource;
use App\Http\Resources\ChatRoomResource;
use App\Http\Resources\GameLobbyResource;
use App\Http\Resources\UserAssetAccountResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class ChatRoomMessageSenderSocketResource extends JsonResource
{
    public function __construct($resource)
    {
        self::withoutWrapping();
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'username' => $this->username,
            'image_url' => $this->image_url,
        ];
    }
}
