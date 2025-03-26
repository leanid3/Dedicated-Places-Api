<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(mixed[] $toArray)
 */
class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $fillable = [
        "category_id",
        "title",
        "content",
        "excerpt",
        "slug",
        "user_id",
        "status",
        "type",
        "stock",
        "price",
        "image",
        "params",
        "SEO_title",
        "SEO_description",
        "SEO_keywords",
        "locale",
        "comment_count",
        "comment_status",
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function casts(): array
    {
        return [
            'params' => 'array'
        ];
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function multiFields(): HasMany
    {
        return $this->hasMany(MultiField::class, 'post_id');
    }
}
