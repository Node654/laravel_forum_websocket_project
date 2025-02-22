<?php

namespace App\Services\Message;

use App\Facades\Notification;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Services\Message\DTO\StoreComplaintData;
use App\Services\Message\DTO\StoreMessageData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessageService
{
    public function store(StoreMessageData $data): Message
    {
        $ids = Str::of($data->body)
            ->matchAll('/@[\d]+/')
            ->unique()
            ->transform(function (string $item) {
                return Str::of($item)->replaceMatches('/@/', '')->value();
            })->filter(function (int $item) {
                return User::query()->where('id', $item)->exists();
            });
        $imgIds = Str::of($data->body)
            ->matchAll('/img=[\d]+/')
            ->transform(function (string $item) {
                return Str::of($item)->replaceMatches('/img=/', '')->value();
            });

        $message = Message::query()->create($data->toArray());
        Image::query()
            ->whereIn('id', $imgIds)
            ->update([
                'message_id' => $message->id,
            ]);
        Image::query()
            ->where('user_id', auth()->id())
            ->whereNull('message_id')
            ->get()
            ->pluck('path')
            ->each(function ($path) {
                Storage::disk('public')->delete($path);
            });
        Image::query()
            ->where('user_id', auth()->id())
            ->whereNull('message_id')
            ->delete();
        $message->answeredUsers()->attach($ids);
        $ids->each(function (int $answeredUserId) use ($message) {
            Notification::store($message, 'Вам ответили!', $answeredUserId);
        });
        return $message;
    }

    public function storeMessageComplaint(StoreComplaintData $data, Message $message): Message
    {
        if ($message->user_id === auth()->id())
        {
            return $message;
        }
        $message->complaintedUsers()->attach(auth()->id(), $data->toArray());
        Notification::store($message, 'На вас пожаловались!');
        Notification::store($message, 'Ваша жалоба в рассмотрении!', auth()->id());
        return $message;
    }
}
