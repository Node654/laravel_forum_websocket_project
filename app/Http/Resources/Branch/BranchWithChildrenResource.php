<?php

namespace App\Http\Resources\Branch;

use App\Http\Resources\Theme\ThemeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchWithChildrenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'parent_id' => $this->parent_id ?? null,
            'section_id' => $this->section_id ?? null,
            'children' => BranchResource::collection($this->children),
            'themes' => ThemeResource::collection($this->themes),
        ];
    }
}
