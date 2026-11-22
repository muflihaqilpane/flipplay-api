<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'genre' => $this->genre,
            'rating' => $this->rating,
            'total_episodes' => $this->total_episodes,
            'collected_by_users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
