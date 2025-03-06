<?php

namespace App\Services\Message;

use App\Events\StoreMessageEvent;
//use App\Facades\Notification;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Message\MessageWithUserResource;
use App\Jobs\ProcessMessageJob;
use App\Models\Image;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use App\Services\Message\DTO\StoreComplaintData;
use App\Services\Message\DTO\StoreMessageData;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageService
{
    public function store(StoreMessageData $data): Message
    {
        $message = Message::query()->create($data->toArray());

        broadcast(new StoreMessageEvent($message))->toOthers();

        ProcessMessageJob::dispatch($data, $message);

        return $message;
    }

    public function storeMessageComplaint(StoreComplaintData $data, Message $message): JsonResource
    {
        if ($message->user_id === auth()->id())
        {
            return MessageWithUserResource::make($message);
        }
        $message->complaintedUsers()->attach(auth()->id(), $data->toArray());
        Notification::insert([
            [
                'title' => 'fddd',
                'user_id' => $message->user_id,
                'url' => route('themes.show', $message->theme_id).'#'.$message->id,
            ],
            [
                'title' => 'fdsfds',
                'user_id' => auth()->id(),
                'url' => route('themes.show', $message->theme_id).'#'.$message->id,
            ]
        ]);
        $message->isNotSolvedComplaint = true;
//        Notification::store($message, 'На вас пожаловались!');
//        Notification::store($message, 'Ваша жалоба в рассмотрении!', auth()->id());
        return MessageWithUserResource::make($message);
    }
}
