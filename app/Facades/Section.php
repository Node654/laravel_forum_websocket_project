<?php

namespace App\Facades;

use App\Services\Section\DTO\SectionData;
use App\Services\Section\SectionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void store(SectionData $data)
 * @method static Collection getSections(array $with = [], array $fields = ['*'])
 * @method static void update(SectionData $data, \App\Models\Section $section)
 *
 * @see SectionService
 */
class Section extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'section_service';
    }
}
