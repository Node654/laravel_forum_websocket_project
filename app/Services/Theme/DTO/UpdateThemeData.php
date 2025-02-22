<?php

namespace App\Services\Theme\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateThemeData extends Data
{
    public function __construct(
        #[MapInputName('title')]
        public string $title,
        #[MapInputName('description')]
        public string|null|Optional $description
    ) {}
}
