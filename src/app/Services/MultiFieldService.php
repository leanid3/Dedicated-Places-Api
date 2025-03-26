<?php

namespace App\Services;

use App\Models\MultiField;
use Illuminate\Support\Facades\Storage;

class MultiFieldService
{
    /**
     * Save photo
     * @param $uploadFile
     * @param $post_id
     * @return void
     */
    public static function storeImage($uploadFile, $post_id): void
    {
        $path = Storage::disk(config('filesystems.default'))->putFile('MultiField', $uploadFile);
        MultiField::create(['path' => $path, 'post_id' => $post_id]);
    }
}
