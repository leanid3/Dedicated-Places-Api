<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
        ];
    }
}
