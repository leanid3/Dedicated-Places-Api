<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'SEO_title' =>  $this->SEO_title,
            'SEO_description' =>  $this->SEO_description,
            'SEO_Keywords' =>  $this->SEO_Keywords,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'posts_meta' => $this->whenLoaded('posts', function () {
                return [
                    'total' => $this->posts->total(),
                    'per_page' => $this->posts->perPage(),
                    'current_page' => $this->posts->currentPage(),
                    'last_page' => $this->posts->lastPage(),
                ];
            }),
       
        ];
    }
}
