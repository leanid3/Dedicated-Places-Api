<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->unsignedBigInteger('category_id'); // Указываем вручную
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
//            $table->foreignId('category_id')->constrained('categories')->on('categories')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['published', 'draft', 'deleted'])->default('published');
            $table->integer('stock')->nullable()->default(0);
            $table->integer('price')->nullable()->default(0);
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
