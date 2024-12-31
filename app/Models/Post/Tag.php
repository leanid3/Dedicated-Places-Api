<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        "name",
        "slug"
    ];

    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id')
            ->withTimestamps();
    }
}
