<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\GameLobby */
class GameLobbyResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'image_url' => $this->image_url,
            'theme_color' => $this->theme_color,
            'type' => $this->type,
            'status' => $this->status,
            'rules' => $this->rules,
            'base_entrance_fee' => $this->base_entrance_fee,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'description' => $this->description,
            'max_players' => $this->max_players,
            'min_players' => $this->min_players,
            'available_spots' => $this->available_spots,
            'has_available_spots' => $this->has_available_spots,
            'players_in_lobby_count' => $this->whenNotNull(
                $this->players_in_lobby_count,
            ),
            'scheduled_at_utc_string' => $this->scheduled_at_utc_string,
            'users_count' => $this->whenNotNull($this->users_count),
            'game_id' => $this->game_id,
            'asset_id' => $this->asset_id,
            'asset' => new AssetResource($this->whenLoaded('asset')),
            'game' => new GameResource($this->whenLoaded('game')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'scores' => UserScoreResource::collection(
                $this->whenLoaded('scores'),
            ),
        ];
    }
}
