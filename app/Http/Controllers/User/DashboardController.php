<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GameLobbyUser;
use App\Models\User;
use App\Models\UserAchievement;
use App\Models\UserScore;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(User $user)
    {
        $totalTimePlayed = UserScore::whereBelongsTo($user)->sum('time_played');

        $topThreePlayedGamesAndTotalTimePlayed = UserScore::where('user_id', $user->id)
            ->selectRaw('game_id, sum(time_played) as total_time_played')
            ->groupBy('game_id')
            ->orderBy('total_time_played', 'DESC')
            ->with('game:id,name')
            ->take(3)
            ->get();

        $lastLobbyPlayedIn = $user
            ->gameLobbies()
            ->latest()
            ->with('game')
            ->first();

        $achievements = UserAchievement::whereBelongsTo($user)
            ->latest()
            ->with(['game:id,name', 'achievement:id,name,description'])
            ->take(5)
            ->get();

        $gamePlayedHistory = $user
            ->gamesScores()
            ->select(['id', 'game_lobby_id', 'game_id', 'rank', 'score'])
            ->with(['game:id,name', 'gameLobby:id,created_at,scheduled_at'])
            ->take(5)
            ->get();

        return Inertia::render('User/Dashboard', [
            'totalPlayed' => GameLobbyUser::whereBelongsTo($user)->count(),
            'totalTimePlayed' => (int) $totalTimePlayed,
            'topPlayedGamesTimeSpent' => $topThreePlayedGamesAndTotalTimePlayed,
            'lastGamePlayed' => $lastLobbyPlayedIn?->game,
            'latestAchievements' => $achievements,
            'latestGamesPlayedHistory' => $gamePlayedHistory,
        ]);
    }
}
