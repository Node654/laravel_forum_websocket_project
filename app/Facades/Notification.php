<?php

namespace App\Facades;

use App\Services\Notification\NotificationService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void store(\App\Models\Message $message, string $title, int $id = null)
 * @method static void update(array $ids)
 *
 * @see NotificationService
 */
class Notification extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NotificationService::class;
    }
}
