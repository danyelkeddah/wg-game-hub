<?php

namespace App\DataTransferObjects;

use App\Http\Requests\GameMatchResultsPayloadRequest;

class GameMatchResultData
{
    public function __construct(
        public readonly array $scores,
        public readonly array $achievements,
    ) {
    }

    public static function fromRequest(
        GameMatchResultsPayloadRequest $request,
    ): self {
        return new self(
            scores: $request->get('scores'),
            achievements: $request->get('achievements'),
        );
    }
}
