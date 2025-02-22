<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Message;
use App\Models\Theme;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class MainController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'branches' => [
                'title' => 'Ветки',
                'count' => Branch::query()->count(),
            ],
            'themes' => [
                'title' => 'Темы',
                'count' => Theme::query()->count(),
            ],
            'messages' => [
                'title' => 'Сообщения',
                'count' => Message::query()->count(),
            ],
            'users' => [
                'title' => 'Пользователи',
                'count' => User::query()->count(),
            ],
        ];

        return Inertia::render('Admin/Main/Index', compact('stats'));
    }
}
