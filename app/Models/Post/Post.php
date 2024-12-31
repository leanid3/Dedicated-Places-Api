<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $primaryKey = 'post_id';
    protected $fillable = [
        "category_id",
        "title",
        "content",
        "excerpt",
        "slug",
        "author_id",
        "status",
        "type",
        "stock",
        "price",
        "params",
        "SEO_title",
        "SEO_description",
        "SEO_keywords",
        "locale",
        "comment_count",
        "comment_status",
    ];

    public function casts(): array
    {
        return [
            'params' => 'array'
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'post_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'post_id');
    }
}
