<?php

namespace App\Services\Notification;

use App\Events\StoreNotificationEvent;
use App\Models\Message;
use App\Models\Notification;

class NotificationService
{
    public static function store(Message $message, string $title, int $id = null): void
    {
        $id = $id ?: $message->user_id;
        $notification = Notification::query()->create([
            'title' => $title,
            'user_id' => $id,
            'url' => route('themes.show', $message->theme_id).'#'.$message->id,
        ]);
        broadcast(new StoreNotificationEvent($notification))->toOthers();
    }

    public static function update(array $ids): void
    {
        Notification::query()->whereIn('id', $ids)->update([
            'is_read' => true
        ]);
    }
}
