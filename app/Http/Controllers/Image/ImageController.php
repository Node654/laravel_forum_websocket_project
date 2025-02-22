<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\StoreRequest;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(StoreRequest $request): JsonResource
    {
        $data = $request->validated();
        $path = Storage::disk('public')->put('/images', Arr::get($data, 'image'));

        $image = Image::query()->create([
            'path' => $path,
            'user_id' => auth()->id(),
        ]);

        return ImageResource::make($image);
    }
}
