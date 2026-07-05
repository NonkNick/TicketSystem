<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketCommentResource extends JsonResource
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
            'user' => UserResource::make($this->whenLoaded('user')),
            'message' => $this->message,
            'edited_at' => $this->edited_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}