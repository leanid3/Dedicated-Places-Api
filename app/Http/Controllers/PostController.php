<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostJsonResource;
use App\Models\Post\Category;
use App\Models\Post\Post;
use http\Env\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllPosts(Request $request, Category $category)
    {
        $categoryID = $request->get("category", $category->categoty_id ?? null);
        if(!$categoryID) return  response()->json(['error' => 'такой категории у нас нет'], 404);

        $posts = Post::with('category')->paginate(20);
        if(!$posts) return response()->json(['error'=> 'в этом разделе ничего нет'], 404);
        return PostJsonResource::collection($posts);
    }

    public function getOneFull(int $post_id)
    {
        $post = Post::all()->find($post_id);
        if (!$post) {
            return response()->json(['message' => 'пост не найден'], 404);
        }
        return new PostJsonResource($post);
    }

    public function getFindQuery(string $query)
    {
        $posts = Post::all()->where('title', 'like', '%' . $query . '%');
        return PostJsonResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createPost(PostRequest $request)
    {
        $post = $request->validated();
        Post::created($post);
        return new PostJsonResource($post);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $post_id)
    {
        $post = Post::all()->find($post_id);
        if (!$post) {
            return response()->json(['message' => 'пост не найден'], 404);
        }
        return new PostJsonResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, int $post_id)
    {
        $data = $request->validated();
        $post = Post::all()->find($post_id);

        if (!$post) {
            return response()->json(['message' => 'пост не найден'], 404);
        }

        $post->update($data);
        return response()->json($post, '200', ['title' => 'пост добавлен успешно']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $post_id)
    {
        $post = Post::all()->find($post_id);
        if (!$post) {
            return response()->json(['message' => 'не удалось найти пост для удаления'], 404);
        }


        if (Post::destroy($post_id)) {
            return response()->json(['message' => 'пост успешно удален']);
        }
        return response()->json(['message' => 'не удалось удалить пост '], 500);
    }
}
