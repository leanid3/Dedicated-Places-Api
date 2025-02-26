<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Post $post
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTagRequest $request
     * @param Tag $tag
     * @return TagResource
     */
    public function store(StoreTagRequest $request, Tag $tag): TagResource
    {
        $tag = $tag->create($request->all());
        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     * @param Tag $tag
     * @return TagResource
     */
    public function show(Tag $tag): TagResource
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return TagResource
     */
    public function update(UpdateTagRequest $request,Tag $tag): TagResource
    {
        $tag->update($request->all());
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();
        return response()->json(null, 204);
    }
}
