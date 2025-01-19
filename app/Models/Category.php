<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        "category_parent_id",
        "name",
        "description",
        "SEO_title",
        "SEO_description",
        "SEO_keywords"
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'category_parent_id' );
    }

    public function parent(): belongsTo
    {
        return $this->belongsTo(Category::class, 'category_parent_id' );
    }
}
