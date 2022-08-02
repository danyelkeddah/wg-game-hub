<?php

namespace App\Http\QueryPipelines\UserAchievementsPipeline\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\matches;

class Sort
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function allowedSortFields(): Collection
    {
        return collect([
            [
                'key' => 'game_name',
                'value' => 'games.name',
            ],
            [
                'key' => 'achievement_name',
                'value' => 'achievements.name',
            ],
            [
                'key' => 'earned_at',
                'value' => 'created_at',
            ],
        ]);
    }

    public function handle(Builder $builder, Closure $next)
    {
        $sortBy = $this->request->get('sort_by');
        $sortOrder = $this->request->get('sort_order', 'asc');

        if (
            !in_array(
                $sortBy,
                $this->allowedSortFields()
                    ->values()
                    ->pluck('key')
                    ->toArray(),
            ) ||
            !in_array($sortOrder, ['asc', 'desc'])
        ) {
            return $next($builder);
        }

        $builder
            ->select('user_achievements.*', 'games.name as game_name')
            ->join('games', 'user_achievements.game_id', '=', 'games.id')
            ->join('achievements', 'user_achievements.achievement_id', '=', 'achievements.id')
            ->orderBy(
                $this->allowedSortFields()
                    ->where('key', $sortBy)
                    ->value('value'),
                $sortOrder,
            );
        return $next($builder);
    }
}
