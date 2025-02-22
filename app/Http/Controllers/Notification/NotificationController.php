<?php

namespace App\Http\Controllers\Notification;

use App\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NotificationController extends Controller
{
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        Notification::update(Arr::get($data, 'ids'));
        return response()->json([
            'count' => auth()->user()->notifications()->count(),
            'notifications' => auth()->user()->notifications
        ]);
    }
}
