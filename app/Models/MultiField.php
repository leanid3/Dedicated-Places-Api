<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MultiField extends Model
{
    protected $table = 'multiFields';
    protected  $primaryKey = 'id';
    protected $fillable = [
        'path',
        'post_id',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
