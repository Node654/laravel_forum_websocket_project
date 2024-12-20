<?php

namespace App\Services\Message;

use App\Models\Message;
use App\Services\Message\DTO\StoreMessageData;

class MessageService
{
    public function store(StoreMessageData $data): Message
    {
        return Message::query()->create($data->toArray());
    }
}
