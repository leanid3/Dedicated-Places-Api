<?php
namespace App\Containers\Post\Actions;
use App\Containers\Post\DTO\SearchPostDTO;
use App\Containers\Post\Tasks\ApplyFilterTask;
use App\Containers\Post\Tasks\SearchQueryTask;
use App\Models\Post;

class SearchPostAction{
    public function __construct(
        private SearchQueryTask $searchQueryTask,
        private ApplyFilterTask $applyFilterTask
    ){}

    public function run (SearchPostDTO $dto){
        $query = Post::with(['tags', 'multifields']);
        $query = $this->searchQueryTask->run($query, $dto->query);
        $query = $this->applyFilterTask->run($query, $dto->tags);
    
        return $query->paginate(10);
    }
}