<?php

namespace App\Http\Resources\Complaint;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'message_id' => $this->message_id,
            'theme_id' => $this->theme_id,
            'body' => $this->body,
            'isSolved' => $this->is_solved,
        ];
    }
}
