<?php

namespace App\Containers\Post\Tasks;

use App\Containers\Post\DTO\BasePostDTO;
use App\Models\Post;
class StorePostTask
{

    public static function run(BasePostDTO $dto)
    {
        return Post::create(
            collect([
                'category_id' => $dto->category_id,
                'title' => $dto->title,
                'content' => $dto->content,
                'excerpt' => $dto->excerpt,
                'slug' => $dto->slug,
                'status' => $dto->status,
                'type' => $dto->type,
                'params' => $dto->params,
                'stock' => $dto->stock,
                'price' => $dto->price,
                'image' => $dto->image,
                'seo_title' => $dto->seo_title,
                'seo_description' => $dto->seo_description,
                'seo_keyword' => $dto->seo_keyword,
                'locale' => $dto->locale,
                'comment_status' => $dto->comment_status,
                'tags' => $dto->tags
            ])->except(['tags', 'image'])->toArray()
        );

    }
}