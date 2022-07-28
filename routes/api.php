<?php

use App\Http\Controllers\API\{
    ChatRooms\ChatRoomMessageController,
    Games\GameLobbiesController,
    Games\GameLobbyJoinController,
    Games\GameLobbyLeaveController,
    Games\GameLobbyResultsController,
    Games\GamesController,
};
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Games
Route::resource('games', GamesController::class)->only('index', 'show');

// Game Lobbies
Route::resource('games.game-lobbies', GameLobbiesController::class)
    ->parameters(['game-lobbies' => 'gameLobby'])
    ->shallow()
    ->only('show', 'index')
    ->scoped();

Route::post(
    'game-lobbies/{gameLobby}/join',
    GameLobbyJoinController::class,
)->name('games.game-lobbies.join');

Route::post(
    'game-lobbies/{gameLobby}/leave',
    GameLobbyLeaveController::class,
)->name('games.game-lobbies.leave');

// Should be protected only by internal
Route::post(
    'game-lobbies/{gameLobby}/results',
    GameLobbyResultsController::class,
);

// Chatroom message
Route::post(
    'chat-rooms/{chatRoom}/message',
    ChatRoomMessageController::class,
)->name('chat-rooms.message');
