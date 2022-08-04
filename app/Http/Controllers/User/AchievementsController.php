<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\QueryPipelines\UserAchievementsPipeline\UserAchievementsPipeline;
use App\Http\Resources\GameResource;
use App\Http\Resources\UserAchievementResource;
use App\Models\Game;
use App\Models\User;
use App\Models\UserAchievement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AchievementsController extends Controller
{
    public function __invoke(User $user, Request $request)
    {
        $achievements = UserAchievementsPipeline::make(
            builder: UserAchievement::query()->whereBelongsTo($user),
            request: $request,
        );

        $games = Game::get(['id', 'name']);

        return Inertia::render('User/Achievements', [
            'userAchievements' => UserAchievementResource::collection($achievements->paginate()->withQueryString()),
            'games' => GameResource::collection($games),
            'filters' => $request->only('sort_by', 'sort_order', 'filter_by_game'),
        ]);
    }
}
