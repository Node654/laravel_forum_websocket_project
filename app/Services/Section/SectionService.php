<?php

namespace App\Services\Section;

use App\Models\Section;
use App\Services\Section\DTO\SectionData;
use Illuminate\Database\Eloquent\Collection;

class SectionService
{
    public function getSections(array $with = [], array $fields = ['*']): Collection
    {
        return Section::query()->select($fields)->with($with)->get();
    }

    public function store(SectionData $data): void
    {
        Section::query()->firstOrCreate($data->toArray());
    }

    public function update(SectionData $data, Section $section): void
    {
        $section->update([
            'title' => $data->title
        ]);
    }
}
