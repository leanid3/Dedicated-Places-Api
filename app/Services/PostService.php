<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * @param array $data
     * @return Post|string
     * @throws \Exception
     */
    public function store(array $data): Post|string
    {
        DB::beginTransaction();
        try {
            $post = Post::create(collect($data)->except(['tags', 'multifields'])->toArray());
            if (!empty($data['tags'])) {
                $this->TagsSync($data['tags'], $post);
            }
            if (!empty($data['multifields'])) {
                MultiFieldService::storeImage($data['multifields'], $post->post_id);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return $post;
    }

    /**
     * @param array $data
     * @param Post $post
     * @return Post|string
     */
    public function update(array $data, Post $post): Post|string
    {
        DB::beginTransaction();
        try {
            $post->update(collect($data)->except('tags', 'multifields')->toArray());
            if (!empty($data['multifields'])) {
                MultiFieldService::storeImage($data['multifields'], $post->post_id);
            }
            $this->TagsSync($data['tags'] ?? [], $post);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["message" => $exception->getMessage()], 500);
        }
        return $post;
    }

    /**
     * @param array $data
     * @param Post $post
     * @return void
     */
    private function TagsSync(array $data, Post $post): void
    {
        $tagsId = collect($data['tags'])->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->tag_id;
        });
        $post->tags()->sync($tagsId);
        $post->load('tags');
    }

}
