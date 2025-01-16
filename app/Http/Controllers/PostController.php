<?php

namespace App\Http\Controllers;

use App\Http\Modules\PostFilter;
use App\Http\Requests\API\V1\PostRequest;
use App\Http\Resources\PostJsonResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        $filter = new PostFilter($request);
        $query = $filter->apply($query);

        $posts = $query->paginate(10);
        return PostJsonResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        $post = Post::create($request->all());
        return new PostJsonResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostJsonResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $request->validated();
        $post->update($request->all());
        return new PostJsonResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('пост удален', 202);
    }
}
