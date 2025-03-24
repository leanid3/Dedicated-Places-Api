<?php 

namespace App\Containers\Post\DTO;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;

class BasePostDTO {
    public int $post_id;
    public ?int $category_id;
    public string $title;
    public ?string $content;
    public ?string $excerpt;
    public ?string $slug;
    public ?string $status;
    public ?string $type;
    public ?string $params;
    public ?int $stock;
    public ?int $price;
    public ?UploadedFile $image;
    public ?string $seo_title;
    public ?string $seo_description;
    public ?string $seo_keyword;
    public ?string $locale;
    public ?string $comment_status;
    public ?array $tags;

    public function __construct(Request $request)
    {
        $this->category_id = $request->input('category_id');
        $this->title = $request->input('title');
        $this->content = $request->input('content');
        $this->excerpt = $request->input('excerpt');
        $this->slug = $request->input('slug');
        $this->status = $request->input('status');
        $this->type = $request->input('type');
        $this->params = $request->input('params');
        $this->stock = $request->input('stock');
        $this->price = $request->input('price');
        $this->image = $request->file('image');
        $this->seo_title = $request->input('seo_title');
        $this->seo_description = $request->input('seo_description');
        $this->seo_keyword = $request->input('seo_keyword');
        $this->locale = $request->input('locale');
        $this->comment_status = $request->input('comment_status');
        $this->tags = $request->input('tags');
    }

}