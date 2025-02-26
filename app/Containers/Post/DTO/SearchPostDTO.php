<?php 
namespace App\Containers\Post\DTO;

use App\Http\Requests\SearchPostRequest;

class SearchPostDTO{
    /**
     * title or content to post
     * @var string
     */
    public string $query;

    /**
     * tags post
     * @var array
     */
    public array $tags;

    public function __construct(SearchPostRequest $request){
        $this->query = $request->input('query', '');
        $this->tags = $request->input('tags', []);
    }
}