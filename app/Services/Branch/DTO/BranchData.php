<?php

namespace App\Services\Branch\DTO;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class BranchData extends Data
{
    public function __construct(
        #[MapInputName('title')]
        public string $title,
        #[MapInputName('section_id')]
        public int $section_id,
        #[MapInputName('parent_id')]
        public int|null|Optional $parent_id,
    )
    {

    }
}
