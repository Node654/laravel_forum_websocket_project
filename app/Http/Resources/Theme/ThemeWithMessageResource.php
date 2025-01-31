<?php

namespace App\Http\Resources\Theme;

use App\Http\Resources\Message\MessageWithUserResource;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeWithMessageResource extends JsonResource
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
            'description' => $this->description,
            'branch_id' => $this->branch_id,
            'messages' => MessageWithUserResource::collection($this->messages()->withCount('likes')->get()),
        ];
    }
}
