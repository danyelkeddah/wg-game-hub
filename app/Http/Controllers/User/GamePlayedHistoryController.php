<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\QueryPipelines\UserGamesPlayedHistoryPipeline\UserGamesPlayedHistoryPipeline;
use App\Http\Resources\GameResource;
use App\Http\Resources\UserScoreResource;
use App\Models\Game;
use App\Models\User;
use App\Models\UserScore;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GamePlayedHistoryController extends Controller
{
    public function __invoke(User $user, Request $request)
    {
        $userScoreBuilder = UserScore::query()->whereBelongsTo($user);

        $gamePlayedHistory = UserGamesPlayedHistoryPipeline::make(
            builder: $userScoreBuilder->with(['game:id,name', 'gameLobby:id,created_at,scheduled_at']),
            request: $request,
        );

        $games = Game::get(['id', 'name']);

        return Inertia::render('User/GamesPlayedHistory', [
            'userGamesPlayedHistory' => UserScoreResource::collection(
                $gamePlayedHistory->paginate()->withQueryString(),
            ),
            'games' => GameResource::collection($games),
            'filters' => $request->only('sort_by', 'sort_order', 'filter_by_game'),
        ]);
    }
}
