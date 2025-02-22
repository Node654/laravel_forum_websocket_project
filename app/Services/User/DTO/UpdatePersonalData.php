<?php

namespace App\Services\User\DTO;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class UpdatePersonalData extends Data
{
    public function __construct(
        #[MapInputName('avatar')]
        public UploadedFile $avatar,
    ) {}
}
