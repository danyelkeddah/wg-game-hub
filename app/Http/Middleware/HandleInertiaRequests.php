<?php

namespace App\Http\Middleware;

use App\Enums\GameLobbyStatus;
use App\Enums\UserAssetAccountStatus;
use Cache;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    protected function loadUserData(Request $request)
    {
        return [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'username' => $request->user()->username,
            'last_name' => $request->user()->last_name,
            'full_name' => $request->user()->full_name,
            'email' => $request->user()->email,
            'image' => $request->user()->image,
            'image_url' => $request->user()->image_url,
            'asset_accounts' => Cache::remember(
                key: 'user.' . $request->user()->id . '.asset_accounts',
                ttl: 300,
                callback: function () use ($request) {
                    return $request
                        ->user()
                        ->assets()
                        ->select('assets.id', 'assets.name', 'assets.symbol')
                        ->wherePivot('status', UserAssetAccountStatus::Active)
                        ->withPivot('balance', 'status')
                        ->get();
                },
            ),
            'current_lobby_session' => Cache::remember(
                key: 'user.' . $request->user()->id . '.current-lobby-session',
                ttl: 60,
                callback: function () use ($request) {
                    $session = $request
                        ->user()
                        ->gameLobbies()
                        ->whereIn('status', [
                            GameLobbyStatus::Scheduled,
                            GameLobbyStatus::InGame,
                            GameLobbyStatus::InLobby,
                        ])
                        ->first();

                    return $session ? $session->only('id', 'game_id', 'name') : null;
                },
            ),
        ];
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'current_url' => url()->current(),
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? $this->loadUserData(request: $request) : null,
                ];
            },
            'config' => [
                'dashboard_art' => asset('images/dashboard-art.png'),
                'main_pattern' => asset('images/main-pattern.png'),
                'game_lobby_pattern' => asset('images/game-lobby-pattern.png'),
                'game_lobby_loading_gif' => asset('images/game-lobby-loading.gif'),
            ],
            'flash' => function () use ($request) {
                return [
                    'error' => session()->get('error'),
                    'success' => session()->get('success'),
                ];
            },
        ]);
    }
}
