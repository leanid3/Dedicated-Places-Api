<?php
namespace App\Containers\Post\Actions;
use App\Containers\Post\DTO\BasePostDTO;
use App\Containers\Post\Tasks\AddImageToPostTask;
use App\Containers\Post\Tasks\AddTagsToPostTask;
use App\Containers\Post\Tasks\StorePostTask;

class StorePostAction
{
    public function run(BasePostDTO $dto)
    {
        $post = StorePostTask::run($dto);
        if (!empty($dto->image)) {
            AddImageToPostTask::run($dto, $post);
        }
        if (!empty($dto->tags)) {
            AddTagsToPostTask::run($dto, $post);
        }
        return $post;

    }

}