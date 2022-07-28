<?php

namespace App\Actions\Games\GameMatchResults;

use App\DataTransferObjects\GameMatchResultData;
use App\Enums\GameLobbyStatus;
use App\Models\GameLobby;

class StoreGameMatchResultAction
{
    public function __construct(
        public StoreAchievementsFromGameMatchResultAction $storeAchievementsFromGameMatchResultAction,
        public StoreScoresFromGameMatchResultAction $storeScoresFromGameMatchResultAction,
    ) {
    }

    public function execute(
        GameLobby $gameLobby,
        GameMatchResultData $gameMatchResultData,
    ): void {
        $this->storeScoresFromGameMatchResultAction->execute(
            gameLobby: $gameLobby,
            gameMatchResultData: $gameMatchResultData,
        );

        $this->storeAchievementsFromGameMatchResultAction->execute(
            gameLobby: $gameLobby,
            gameMatchResultData: $gameMatchResultData,
        );

        $gameLobby->status = GameLobbyStatus::ResultsProcessed;
        $gameLobby->save();

        // TODO: Dispatch queued task to start distributing the prizes.
    }
}
