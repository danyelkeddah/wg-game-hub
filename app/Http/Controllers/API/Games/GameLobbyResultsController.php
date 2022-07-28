<?php

namespace App\Http\Controllers\API\Games;

use App\Actions\Games\GameMatchResults\StoreGameMatchResultAction;
use App\DataTransferObjects\GameMatchResultData;
use App\Enums\GameLobbyStatus;
use App\Events\GameLobby\ProcessingResultsEvent;
use App\Events\GameLobby\ResultsProcessedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\GameMatchResultsPayloadRequest;
use App\Models\GameLobby;

class GameLobbyResultsController extends Controller
{
    public function __construct(
        public StoreGameMatchResultAction $storeGameMatchResultAction,
    ) {
    }

    public function __invoke(
        GameMatchResultsPayloadRequest $request,
        GameLobby $gameLobby,
    ) {
        $gameLobby->status = GameLobbyStatus::ProcessingResults;
        $gameLobby->save();

        broadcast(new ProcessingResultsEvent(gameLobby: $gameLobby));

        $gameMatchResultData = GameMatchResultData::fromRequest(
            request: $request,
        );

        $this->storeGameMatchResultAction->execute(
            gameLobby: $gameLobby,
            gameMatchResultData: $gameMatchResultData,
        );

        broadcast(
            new ResultsProcessedEvent(
                gameLobby: $gameLobby->fresh(['users', 'scores']),
            ),
        );

        return response()->noContent();
    }
}
