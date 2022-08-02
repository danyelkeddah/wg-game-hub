<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\QueryPipelines\UserAchievementsPipeline\UserAchievementsPipeline;
use App\Http\Resources\UserAchievementResource;
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

        return Inertia::render('User/Achievements', [
            'userAchievements' => UserAchievementResource::collection($achievements->paginate()->withQueryString()),
            'filters' => $request->only('sort_by', 'sort_order'),
        ]);
    }
}
