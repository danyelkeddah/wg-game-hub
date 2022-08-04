<?php

namespace App\Http\QueryPipelines\UserAchievementsPipeline\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByGameFilter
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Builder $builder, Closure $next)
    {
        $builder->when($this->request->get('filter_by_game'), function (Builder $builder, $gameId) {
            $builder->where('user_achievements.game_id', $gameId);
        });

        return $next($builder);
    }
}
