<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'post_id' => $this->post_id,
            "category_id" => $this->category_id,
            "title" => $this->title,
            "content" => $this->content,
            "excerpt" => $this->excerpt,
            "slug" => $this->slug,
            "author_id" => $this->author_id,
            "status" => $this->status,
            "type" => $this->type,
            "stock" => $this->stock,
            "price" => $this->price,
            "params" => $this->params,
            "SEO_title" => $this->SEO_title,
            "SEO_description" => $this->SEO_description,
            "SEO_keywords" => $this->SEO_keywords,
            "locale"=> $this->locale,
            "comment_count" => $this->comment_count,
            "comment_status" => $this->comment_status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
    public function getMessage($request){
        return [
            'message' => $request->message,
            'status' => $request->status,
        ]
    }
}
