<?php

use App\Models\Post\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PharIo\Manifest\Author;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->foreignIdFor(Category::class, 'category_id');
            $table->string('title');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->foreignIdFor(User::class, 'user_id');
            $table->enum('status', ['published', 'draft', 'deleted','archived'])->default('published');
            $table->enum('type', ['article', 'news', 'review'])->default('article');
            $table->integer('stock')->nullable()->default(0);
            $table->decimal('price', 10, 2)->nullable()->default(0);
            $table->json('params')->nullable();
            $table->string('SEO_title')->nullable();
            $table->text('SEO_description')->nullable();
            $table->string('SEO_keywords')->nullable();
            $table->string('locale')->default('ru');
            $table->integer('comment_count')->default(0);
            $table->enum('comment_status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
