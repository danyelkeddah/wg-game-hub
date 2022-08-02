<?php

namespace App\Models;

use App\Builders\GameBuilder;
use App\Enums\GameStatus;
use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;

    protected $casts = [
        'status' => GameStatus::class,
    ];

    protected $appends = ['image_url'];

    public function newEloquentBuilder($query): GameBuilder
    {
        return new GameBuilder(query: $query);
    }

    public function gameLobbies(): HasMany
    {
        return $this->hasMany(GameLobby::class);
    }

    public function gameMatchScores(): HasMany
    {
        return $this->hasMany(UserScore::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class, 'game_id');
    }

    public function imageUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                return "https://picsum.photos/seed/{$this->id}/1280/720";
            },
        );
    }
}
