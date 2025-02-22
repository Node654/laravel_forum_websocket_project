<?php

namespace App\Services\Message\DTO;

use Spatie\LaravelData\Data;

class StoreComplaintData extends Data
{
    public function __construct(
        public int $theme_id,
        public string $body
    ) {}
}
