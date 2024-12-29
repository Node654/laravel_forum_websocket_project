<?php

namespace App\Facades;

use App\Services\User\DTO\UpdatePersonalData;
use App\Services\User\UserService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResource updatePersonal(UpdatePersonalData $data)
 *
 * @see UserService::class
 */
class User extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserService::class;
    }
}
