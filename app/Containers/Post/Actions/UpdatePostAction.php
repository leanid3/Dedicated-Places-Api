<?php

namespace App\Containers\Post\Actions;

use App\Containers\Post\DTO\BasePostDTO;
use App\Containers\Post\Tasks\AddImageToPostTask;
use App\Containers\Post\Tasks\AddTagsToPostTask;
use App\Containers\Post\Tasks\GetPostByIdTask;

class UpdatePostAction
{
    public function __construct(
        private GetPostByIdTask $getPostByIdTask,
        private AddImageToPostTask $addImageToPostTask,
        private AddTagsToPostTask $addTagsToPostTask
    ) {
    }

    public function run(BasePostDTO $dto)
    {
        $post = $this->getPostByIdTask::run($dto);
        if (!empty($dto->image)) {
            $this->addImageToPostTask::run($dto, $post);
        }
        $this->addTagsToPostTask::run($dto, $post);
        return $post;
    }
}