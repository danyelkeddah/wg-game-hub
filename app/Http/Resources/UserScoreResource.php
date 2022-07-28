<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\UserScore */
class UserScoreResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'rank' => $this->rank,
            'score' => $this->score,
            'time_played' => $this->time_played,

            'game_id' => $this->game_id,
            'game_lobby_id' => $this->game_lobby_id,
            'user_id' => $this->user_id,

            'game' => new GameResource($this->whenLoaded('game')),
            'game_lobby' => new GameLobbyResource(
                $this->whenLoaded('gameLobby'),
            ),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
