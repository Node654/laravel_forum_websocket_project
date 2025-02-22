<?php

namespace App\Services\Section\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class SectionData extends Data
{
    public function __construct(
        #[MapInputName('title')]
        public string $title
    ) {}
}
