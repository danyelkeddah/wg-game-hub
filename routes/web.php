<?php

use App\Http\Controllers\{
    GamesController,
    ChatRooms\ChatRoomMessageController,
    DashboardController,
    GameLobbies\GameLobbyJoinController,
    GameLobbies\GameLobbyLeaveController,
    GameLobbies\GameLobbiesController,
    ProfileController,
    User\AchievementsController as UserAchievementsController,
    User\DashboardController as UserDashboardController,
    User\GamePlayedHistoryController as UserGamePlayedHistoryController,
};
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name(name: 'landing');
Route::resource('games', GamesController::class)->only('show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', ProfileController::class)
        ->middleware('auth')
        ->name(name: 'profile');

    Route::resource('games.game-lobbies', GameLobbiesController::class)
        ->parameters(['game-lobbies' => 'gameLobby'])
        ->shallow()
        ->only('show')
        ->scoped();

    // GameLobbies
    Route::post('game-lobbies/{gameLobby}/join', GameLobbyJoinController::class)->name('games.game-lobbies.join');

    Route::delete('game-lobbies/{gameLobby}/leave', GameLobbyLeaveController::class)->name('games.game-lobbies.leave');

    // Chat Rooms
    Route::post('chat-rooms/{chatRoom}/message', ChatRoomMessageController::class)->name('chat-rooms.message');

    Route::get('/w/{user:username}', UserDashboardController::class)->name('user.profile');
    Route::get('/w/{user:username}/achievements', UserAchievementsController::class)->name('user.achievements');
    Route::get('/w/{user:username}/games-played-history', UserGamePlayedHistoryController::class)->name(
        'user.games-played-history',
    );
});
