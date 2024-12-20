<?php

namespace App\Facades;

use App\Services\Theme\DTO\StoreThemeData;
use App\Services\Theme\DTO\UpdateThemeData;
use App\Services\Theme\ThemeService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void store(StoreThemeData $data)
 * @method static void update(UpdateThemeData $data, \App\Models\Theme $theme)
 *
 * @see ThemeService
 */
class Theme extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ThemeService::class;
    }
}
