<?php 
namespace App\Containers\Post\Tasks;
use Illuminate\Database\Eloquent\Builder;

class SearchQueryTask {
    /**
     * Apply search query to the query
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function run(Builder $query, ?string $search): Builder{
        if (empty($search)) {
            return $query;
        }
        return $query->when($search, function($q) use($search){
            $q->where('title', 'like', "%".$search."%")
                ->orWhere('content', 'like', "%".$search."%");
        });
    }
}