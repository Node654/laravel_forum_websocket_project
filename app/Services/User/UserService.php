<?php

namespace App\Services\User;

use App\Http\Resources\User\UserResource;
use App\Services\User\DTO\UpdatePersonalData;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\Laravel\Facades\Image;

class UserService
{
    public function updatePersonal(UpdatePersonalData $data): JsonResource
    {
        $path = $data->avatar->storePublicly('avatars');
        if (auth()->user()->avatar)
        {
            Storage::disk('public')->delete(auth()->user()->avatar);
        }
        auth()->user()->update([
            'avatar' => $path
        ]);
        $path = Image::read('storage/' . $path)->resize(24, 24);
        $path->save();
        return UserResource::make(auth()->user());
    }
}
