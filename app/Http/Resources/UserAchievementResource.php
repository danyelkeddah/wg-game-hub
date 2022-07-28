<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\UserAchievement */
class UserAchievementResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'additional_info' => $this->additional_info,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'game_id' => $this->game_id,
            'game_lobby_id' => $this->game_lobby_id,
            'achievement_id' => $this->achievement_id,
            'user_id' => $this->user_id,

            'achievement' => new AchievementResource(
                $this->whenLoaded('achievement'),
            ),
            'game' => new GameResource($this->whenLoaded('game')),
            'gameLobby' => new GameLobbyResource(
                $this->whenLoaded('gameLobby'),
            ),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
