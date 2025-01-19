<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'comment' => $this->comment,
            'status' => $this->status,
            'post_id' => $this->post_id,
            'author' => new UserResource($this->author_id),
        ];
    }
}
