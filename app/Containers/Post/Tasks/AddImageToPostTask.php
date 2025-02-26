<?php 
namespace App\Containers\Post\Tasks;

use App\Containers\Post\DTO\BasePostDTO;
use App\Models\MultiField;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class AddImageToPostTask{
    public static function run(BasePostDTO $dto, Post $post){
        $path = Storage::disk(config('filesystems.default'))->putFile('MultiField', $dto->image);
        MultiField::create(['path' => $path, 'post_id' => $post->id]);
    }
}