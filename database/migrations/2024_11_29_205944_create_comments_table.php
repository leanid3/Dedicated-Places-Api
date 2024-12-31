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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Убираем дублирование для 'parent_id'
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade'); // Внешний ключ для родительского комментария

            $table->string('title');
            $table->text('comment');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // Внешний ключ для поста
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
            // Внешний ключ для пользователя (автора комментария)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
