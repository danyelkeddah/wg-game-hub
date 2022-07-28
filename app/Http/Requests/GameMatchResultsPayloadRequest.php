<?php

namespace App\Http\Requests;

use App\Models\Achievement;
use App\Models\User;
use App\Rules\AllExistsInArrayOfObjects;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameMatchResultsPayloadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'scores' => [
                'required',
                'array',
                new AllExistsInArrayOfObjects(
                    modelClass: User::class,
                    column: 'id',
                    objectAttribute: 'user_id',
                ),
                // Todo: All belongs to lobby
            ],
            'achievements' => [
                'present',
                'array',
                new AllExistsInArrayOfObjects(
                    modelClass: Achievement::class,
                    column: 'id',
                    objectAttribute: 'achievement_id',
                ),
                new AllExistsInArrayOfObjects(User::class, 'id', 'user_id'),
                // Todo: All belongs to lobby
            ],
            'scores.*.user_id' => ['required', 'uuid'],
            'scores.*.rank' => ['required', 'numeric'],
            'scores.*.score' => ['required', 'numeric'],
            'scores.*.time_played' => ['required', 'numeric'],
            'achievements.*.user_id' => ['required', 'uuid'],
            'achievements.*.achievement_id' => ['required', 'uuid'],
            'achievements.*.additional_info' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        /** @var \App\Enums\GameLobbyStatus $gameLobbyStatus */
        $gameLobbyStatus = $this->gameLobby->status;
        return $gameLobbyStatus->canProcessResult();
    }
}
