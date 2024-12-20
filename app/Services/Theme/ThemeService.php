<?php

namespace App\Services\Theme;

use App\Models\Theme;
use App\Services\Theme\DTO\StoreThemeData;
use App\Services\Theme\DTO\UpdateThemeData;

class ThemeService
{
    public function store(StoreThemeData $data): void
    {
        Theme::query()->create($data->toArray());
    }

    public function update(UpdateThemeData $data, Theme $theme): void
    {
        $theme->update($data->toArray());
    }
}
