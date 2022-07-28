<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\GameLobbyTemplate */
class GameLobbyTemplateResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'game_id' => $this->game_id,
            'name' => $this->name,
            'image' => $this->image,
            'theme_color' => $this->theme_color,
            'description' => $this->description,
            'rules' => $this->rules,
            'asset_id' => $this->asset_id,
            'base_entrance_fee' => $this->base_entrance_fee,
            'min_players' => $this->min_players,
            'max_players' => $this->max_players,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
