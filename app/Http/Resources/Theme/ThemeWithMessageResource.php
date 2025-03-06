<?php

namespace App\Http\Resources\Theme;

use App\Http\Resources\Message\MessageWithUserResource;
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
        $msgIds = auth()->user()->likes()->get()->pluck('id');

        $this->messages->each(function ($message) use ($msgIds) {
            $message->isLiked = $msgIds->contains($message->id);
        });
        $complaintIds = auth()->user()->complaintedMessages()->get()->pluck('id');

        $this->messages->each(function ($message) use ($complaintIds) {
            $message->isNotSolvedComplaint = $complaintIds->contains($message->id);
        });

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'branch_id' => $this->branch_id,
            'messages' => MessageWithUserResource::collection($this->messages->load('user')->loadCount('likes')),
        ];
    }
}
