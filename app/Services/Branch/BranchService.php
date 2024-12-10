<?php

namespace App\Services\Branch;

use App\Http\Resources\Branch\BranchResource;
use App\Models\Branch;
use App\Models\Section;
use App\Services\Branch\DTO\BranchData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BranchService
{
    public function getBranches(array $with = [], array $fields = ['*'], Section $section = null): Collection
    {
        return isset($section) ? $section->branches()->select($fields)->get() : Branch::query()->select($fields)->get();
    }

    public function store(BranchData $data): void
    {
        $section = Section::query()->find($data->section_id);
        $section->branches()->firstOrCreate($data->toArray());
    }

    public function update(BranchData $data, Branch $branch): void
    {
        $branch->update($data->toArray());
    }
}
