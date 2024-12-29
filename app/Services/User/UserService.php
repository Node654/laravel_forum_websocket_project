<?php

namespace App\Services\User;

use App\Http\Resources\User\UserResource;
use App\Services\User\DTO\UpdatePersonalData;
use Illuminate\Http\Resources\Json\JsonResource;

class UserService
{
    public function updatePersonal(UpdatePersonalData $data): JsonResource
    {
        $path = 'storage/' . $data->avatar->storePublicly('avatars');
        auth()->user()->update([
            'avatar' => $path
        ]);
        return UserResource::make(auth()->user());
    }
}
