<?php

namespace App\Actions\Games\GameMatchResults;

use App\DataTransferObjects\GameMatchResultData;
use App\Models\GameLobby;
use App\Models\UserAchievement;

class StoreAchievementsFromGameMatchResultAction
{
    public function execute(
        GameLobby $gameLobby,
        GameMatchResultData $gameMatchResultData,
    ): void {
        $gameMatchAchievementsModels = collect(
            $gameMatchResultData->achievements,
        )->map(
            fn($playerAchievement) => new UserAchievement(
                $this->attributes(
                    gameLobby: $gameLobby,
                    playerAchievements: $playerAchievement,
                ),
            ),
        );

        $gameLobby->usersAchievements()->saveMany($gameMatchAchievementsModels);
    }

    protected function attributes(
        GameLobby $gameLobby,
        array $playerAchievements,
    ): array {
        $playerAchievements = collect($playerAchievements)
            ->only('user_id', 'achievement_id', 'additional_info')
            ->toArray();

        return array_merge($playerAchievements, [
            'game_id' => $gameLobby->game_id,
            'game_lobby_id' => $gameLobby->id,
        ]);
    }
}
