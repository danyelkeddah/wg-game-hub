<?php

namespace App\Enums;

enum GameLobbyStatus: int
{
    case Scheduled = 10;
    case InLobby = 20;
    case InGame = 30;
    case GameEnded = 40;
    case ProcessingResults = 50;
    case ResultsProcessed = 60;
    case DistributingPrizes = 70;
    case PrizesDistributed = 80;
    case Archived = 90;

    public function canProcessResult(): bool
    {
        return $this === GameLobbyStatus::GameEnded;
    }

    public function canJoinLobby(): bool
    {
        return in_array($this, [
            GameLobbyStatus::Scheduled,
            GameLobbyStatus::InLobby,
        ]);
    }

    public function canWatchLobby(): bool
    {
        return in_array($this, [
            GameLobbyStatus::InLobby,
            GameLobbyStatus::InGame,
            GameLobbyStatus::GameEnded,
            GameLobbyStatus::ProcessingResults,
        ]);
    }
}
