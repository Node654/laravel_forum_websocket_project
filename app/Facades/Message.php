<?php

namespace App\Facades;

use App\Services\Message\DTO\StoreComplaintData;
use App\Services\Message\DTO\StoreMessageData;
use App\Services\Message\MessageService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Message store(StoreMessageData $data)
 * @method static \App\Models\Message storeMessageComplaint(StoreComplaintData $data, \App\Models\Message $message)
 *
 * @see MessageService
 */
class Message extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MessageService::class;
    }
}
