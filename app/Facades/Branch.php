<?php

namespace App\Facades;

use App\Models\Section;
use App\Services\Branch\BranchService;
use App\Services\Branch\DTO\BranchData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @method static void store(BranchData $data)
 * @method static Collection getBranches(array $with = [], array $fields = ['*'], Section $section = null)
 *
 * @see BranchService
 */
class Branch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'branch_service';
    }
}
