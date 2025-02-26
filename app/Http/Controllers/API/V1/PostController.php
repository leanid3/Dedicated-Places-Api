<?php

namespace App\Http\Controllers\API\V1;

use App\Containers\Post\Actions\SearchPostAction;
use App\Containers\Post\Actions\StorePostAction;
use App\Containers\Post\Actions\UpdatePostAction;
use App\Containers\Post\DTO\SearchPostDTO;
use App\Containers\Post\DTO\StorePostDTO;
use App\Containers\Post\DTO\UpdatePostDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetPostRequest;
use App\Http\Requests\SearchPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return ResourceCollection
     */
    public function index(GetPostRequest $request): ResourceCollection
    {
        $per_page = $request->input('per_page', 10);
        
        $query = Post::with(['tags', 'multifields']);
        $posts = $query->paginate($per_page);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePostRequest $request
     * @return PostResource|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StorePostRequest $request, StorePostAction $action): PostResource|\Illuminate\Http\JsonResponse
    {
        $dto = new StorePostDTO($request);
        $post = $action->run($dto);
        return $post instanceof Post
            ? new PostResource($post)
            : response()->json(["message" => $post]);
    }

    /**
     * Display the specified resource.
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        $post->load(['multiFields', 'categories', 'tags']);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, Post $post, UpdatePostAction $action): PostResource
    {
        $dto = new UpdatePostDTO($request);
        $dto->post_id = $post->post_id;

        $post = $action->run($dto);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json('пост удален', 202);
    }

    /**
     * Search posts
     * @param \App\Http\Requests\SearchPostRequest $request
     * @param \App\Containers\Post\Actions\SearchPostAction $action
     */
    public function search(SearchPostRequest $request, SearchPostAction $action)
    {
        try {
            $dto = new SearchPostDTO($request);
            $result = $action->run($dto);
            return PostResource::collection($result);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
