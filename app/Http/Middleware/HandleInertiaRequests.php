<?php

namespace App\Http\Middleware;

use App\Http\Resources\Notification\NotificationResource;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'roles' => $request->user() ? $request->user()->roles()->get()->pluck('code')->toArray() : null,
                'notifications' => $request->user() ? NotificationResource::collection($request->user()->notifications) : null,
                'notification_count' => $request->user() ? $request->user()->notifications()->count() : null,
            ],
        ];
    }
}
