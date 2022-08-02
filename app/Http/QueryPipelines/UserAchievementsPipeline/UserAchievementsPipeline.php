<?php

namespace App\Http\QueryPipelines\UserAchievementsPipeline;

use App\Http\QueryPipelines\UserAchievementsPipeline\Filters\Sort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;

class UserAchievementsPipeline extends Pipeline
{
    protected ?Request $request;

    public function setRequest(Request $request): static
    {
        $this->request = $request;

        return $this;
    }

    protected function pipes()
    {
        return [new Sort(request: $this->request)];
    }

    public static function make(Builder $builder, Request $request): Builder
    {
        return app(static::class)
            ->setRequest(request: $request)
            ->send(
                $builder->with([
                    'game' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'achievement' => function ($query) {
                        $query->select('id', 'name', 'description');
                    },
                ]),
            )
            ->thenReturn();
    }
}
