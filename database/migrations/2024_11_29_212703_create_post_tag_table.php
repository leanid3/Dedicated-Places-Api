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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();

            // Внешний ключ для post_id
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');

            // Внешний ключ для tag_id
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
