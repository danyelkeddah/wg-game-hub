<?php

namespace App\Actions\Games\GameLobbies;

use App\Enums\Reactions\AddUserToGameLobbyReaction;
use App\Events\GameLobby\UserJoinedGameLobbyEvent;
use App\Models\ChatRoomUser;
use App\Models\GameLobby;
use App\Models\User;
use App\Models\WodoAssetAccount;
use DB;

class AddUserToGameLobbyAction
{
    public function execute(
        User $user,
        GameLobby $gameLobby,
    ): GameLobby|AddUserToGameLobbyReaction {
        return DB::transaction(
            callback: function () use ($user, $gameLobby) {
                $gameLobby = GameLobby::query()
                    ->lockForUpdate()
                    ->findOrFail($gameLobby->id);

                if (!$gameLobby->has_available_spots) {
                    return AddUserToGameLobbyReaction::NoAvailableSpots;
                }

                if (
                    $gameLobby
                        ->users()
                        ->where('users.id', $user->id)
                        ->exists()
                ) {
                    return AddUserToGameLobbyReaction::UserAlreadyJoinedTheGameLobby;
                }

                $userAssetAccount = $user
                    ->assetAccounts()
                    ->lockForUpdate()
                    ->where('asset_id', $gameLobby->asset_id)
                    ->first();

                if (
                    $userAssetAccount->balance < $gameLobby->base_entrance_fee
                ) {
                    return AddUserToGameLobbyReaction::InsufficientFunds;
                }
                $userAssetAccount->decrement(
                    'balance',
                    $fee = $gameLobby->base_entrance_fee,
                );

                $gameLobby->users()->syncWithPivotValues(
                    ids: $user->id,
                    values: [
                        'entrance_fee' => $fee,
                        'joined_at' => now(),
                    ],
                    detaching: false,
                );
                ChatRoomUser::firstOrCreate([
                    'chat_room_id' => $gameLobby->id,
                    'user_id' => $user->id,
                ]);

                $wodoAssetAccount = WodoAssetAccount::query()
                    ->where('asset_id', $gameLobby->asset_id)
                    ->first();

                $wodoAssetAccount->increment('balance', $fee);

                $gameLobby->decrement('available_spots');

                broadcast(
                    new UserJoinedGameLobbyEvent(
                        gameLobby: $gameLobby,
                        user: $user,
                    ),
                );
                return $gameLobby;
            },
        );
    }
}
