<?php 

namespace App\Containers\Post\Tasks;

use App\Containers\Post\DTO\BasePostDTO;
use App\Models\Post;

class GetPostByIdTask{
    public static function run(BasePostDTO $dto){
        return Post::findOrFail($dto->post_id);
    }
}