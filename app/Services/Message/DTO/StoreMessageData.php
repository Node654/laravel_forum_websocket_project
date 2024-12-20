<?php

namespace App\Services\Message\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class StoreMessageData extends Data
{
    public function __construct(
        #[MapInputName('body')]
        public string $body,
        #[MapInputName('theme_id')]
        public int $theme_id,
        #[MapInputName('user_id')]
        public int $user_id,
    )
    {
    }
}
