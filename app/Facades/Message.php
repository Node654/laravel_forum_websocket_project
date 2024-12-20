<?php

namespace App\Facades;

use App\Services\Message\DTO\StoreMessageData;
use App\Services\Message\MessageService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Message store(StoreMessageData $data)
 */
class Message extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MessageService::class;
    }
}
