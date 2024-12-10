<?php

namespace App\Services\Branch\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

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
