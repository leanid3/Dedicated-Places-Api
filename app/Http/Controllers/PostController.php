<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
        return response()->json($posts);
    }

    public function getOneFull(int $id)
    {
        $post = Post::all()->find($id);
        if (!$post) {
            return response()->json(['message' => 'пост не найден'], 404);
        }
        return response()->json($post);
    }

    public function getFindQuery(string $query)
    {
        $posts = Post::all()->where('title', 'like', '%' . $query . '%');
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createPost(PostRequest $request)
    {
        $post = $request->validated();
        Post::created($post);
        return response()->json($post, 201);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = Post::all()->find($id);
        if (!$post) {
            return response()->json(['message' => 'пост не найден'], 404);
        }
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, int $id)
    {
        $data = $request->validated();
        $post = Post::all()->find($id);

        if (!$post) {
            return response()->json(['message' => 'пост не найден'], 404);
        }

        $post->update($data);
        return response()->json($post, '200', ['title' => 'пост добавлен успешно']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {
        $post = Post::all()->find($id);
        if (!$post) {
            return response()->json(['message' => 'не удалось найти пост для удаления'], 404);
        }


        if (Post::destroy($id)) {
            return response()->json(['message' => 'пост успешно удален']);
        }
        return response()->json(['message' => 'не удалось удалить пост '], 500);
    }
}
