<?php

namespace App\Http\QueryPipelines\UserGamesPlayedHistoryPipeline\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
                'key' => 'played_at',
                'value' => 'game_lobbies.scheduled_at',
            ],
            [
                'key' => 'score',
                'value' => 'score',
            ],
            [
                'key' => 'rank',
                'value' => 'rank',
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
            ->select(['id', 'game_lobby_id', 'game_id', 'rank', 'score'])
            //            ->with('game:id,name', 'gameLobby:id,created_at,scheduled_at')
            ->orderBy(
                $this->allowedSortFields()
                    ->where('key', $sortBy)
                    ->value('value'),
                $sortOrder,
            );

        $builder
            ->select('user_scores.*', 'games.name as game_name')
            ->join('games', 'user_scores.game_id', '=', 'games.id')
            ->join('game_lobbies', 'user_scores.game_lobby_id', '=', 'game_lobbies.id')
            ->orderBy(
                $this->allowedSortFields()
                    ->where('key', $sortBy)
                    ->value('value'),
                $sortOrder,
            );
        return $next($builder);
    }
}
