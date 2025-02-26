<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class PostResource extends JsonResource
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
            "title" => $this->title,
            "content" => $this->content,
            "excerpt" => $this->excerpt,
            "slug" => $this->slug,
            "user_id" =>$this->when(Route::currentRouteNamed('posts.show')  ,$this->user_id),
            "status" => $this->status,
            "type" => $this->type,
            "stock" => $this->stock,
            "price" => $this->price,
            'MultiFields' => MultiFieldResource::collection($this->multiFields),
            "params" => $this->params,
            "SEO_title" => $this->SEO_title,
            "SEO_description" => $this->SEO_description,
            "SEO_keywords" => $this->SEO_keywords,
            "locale"=> $this->locale,
            "tags" => TagResource::collection($this->tags),
            "comment_count" => $this->comment_count,
            "comment_status" => $this->comment_status,
            "comments" => $this->when(Route::currentRouteNamed('posts.show'), CommentResource::collection($this->comments)),
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),

        ];
    }
    public function getMessage($request){
        return [
            'message' => $request->message,
            'status' => $request->status,
        ];
    }
}
