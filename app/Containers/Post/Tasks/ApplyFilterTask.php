<?php
namespace App\Containers\Post\Tasks;

use Illuminate\Database\Eloquent\Builder;

class ApplyFilterTask {
    /**
     * Apply filters to the query
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $tags
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function run(Builder $query, array $tags): Builder {
       if (empty($tags)) {
        return $query;
       }
       return $query->whereHas('tags', function ($q) use ($tags) {
        $q->whereIn('name', $tags); 
    });
    }
}