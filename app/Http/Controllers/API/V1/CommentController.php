<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Post $post
     * @return ResourceCollection
     */
    public function index(Post $post): ResourceCollection
    {
        $posts = $post->comments()->paginate(10);
        return CommentResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCommentRequest $request
     * @param Post $post
     * @return CommentResource
     */
    public function store(StoreCommentRequest $request, Post $post): CommentResource
    {
        $comment = $post->comments()->create($request->all());
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     * @param Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return CommentResource
     */
    public function update(UpdateCommentRequest $request, Comment $comment): CommentResource
    {
        $comment->update($request->all());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     * @param Comment $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response(['message' => 'комментарий удален'], 204);
    }
}
