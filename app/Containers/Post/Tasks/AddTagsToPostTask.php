<?php
namespace App\Containers\Post\Tasks;

use App\Containers\Post\DTO\BasePostDTO;
use App\Models\Post;
use App\Models\Tag;

class AddTagsToPostTask
{
    public static function run(BasePostDTO $dto, Post $post)
    {
        $tagsId = collect($dto->tags)->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->tag_id;
        });
        $post->tags()->sync($tagsId);
        $post->load('tags');
    }
}