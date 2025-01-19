<?php

namespace Tests\Feature;

use App\Models\Post;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class PostTest extends TestCase
{
//    use RefreshDatabase;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        $this->seed(TestDatabaseSeeder::class);
//    }

    /**
     * A basic feature test example.
     */
    public function test_post_index(): void
    {
        $response = $this->get('/api/v1/posts');

        $response->assertStatus(200);
//        $response->assertJsonPath('data', []);
    }

//    public function test_post_create(): void
//    {
//        $response = $this->get('/api/v1/posts');
//
//        $response->assertStatus(201);
//        $response->assertJsonPath('data', []);
//    }

    public function test_post_show(): void
    {
        //create post
        $post = Post::factory()->create([
            'post_id' => '2222',
            'category_id' => 1,
            'title' => 'Test post',
            'content' => 'Test post content',
            'slug' => 'test-post',
            'status' => 'archived',
            'type' => 'article',
            'stock' => 35,
            'price' => null,
            'SEO_title' => 'Doloremque aut et quia adipisci dignissimos.',
            'SEO_description' => 'Quia corrupti vel natus aut sit.',
            'SEO_keywords' => 'commodi, velit, laborum, dolorem, sed',
            'locale' => 'bs_BA',
        ]);
        //search post of db
        $this->assertDatabaseHas('posts', ['post_id' => $post->id]);

        //get post
        $response = $this->get("/api/v1/posts/{$post->post_id}");
        $response->assertStatus(200);

        //validate response
        $response->assertJsonStructure([
            'data' => [
                'post_id',
                'category_id',
                'title',
                'content',
                'slug',
                'status',
                'type',
                'stock',
                'price',
                'SEO_title',
                'SEO_description',
                'SEO_keywords',
                'locale',
                'created_at',
                'updated_at',
            ],
        ]);
        $response->assertJsonPath('data.post_id', $post->post_id);
        $response->assertJsonPath('data.category_id', $post->category_id);
        $response->assertJsonPath('data.title', $post->title);
        $response->assertJsonPath('data.content', $post->content);
        $response->assertJsonPath('data.SEO_title', $post->SEO_title);

        //delete oost
        $this->delete("/api/v1/posts/{$post->post_id}");
        $this->assertDatabaseMissing('posts', ['post_id' => $post->id]);
    }

//    public function test_post_update(): void
//    {
//        $response = $this->get('/api/v1/posts');
//
//        $response->assertStatus(200);
//        $response->assertJsonPath('data', []);
//    }
//
//    public function test_post_delete(): void
//    {
//        $response = $this->get('/api/v1/posts');
//
//        $response->assertStatus(200);
//        $response->assertJsonPath('data', []);
//    }

}
