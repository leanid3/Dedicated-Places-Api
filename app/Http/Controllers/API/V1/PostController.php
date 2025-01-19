<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Modules\PostFilter;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{
    protected PostService $postService;
    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return ResourceCollection
     */
    public function index(Request $request): ResourceCollection
    {
        $query = Post::with(['categories', 'tags', 'multifields']);

        $filter = new PostFilter($request);
        $query = $filter->apply($query);

        $posts = $query->paginate(10);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePostRequest $request
     * @return PostResource|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StorePostRequest $request) : PostResource | \Illuminate\Http\JsonResponse
    {

        $post = $this->postService->store($request->all());
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
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $post = $this->postService->update($request->all(), $post);
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
}
