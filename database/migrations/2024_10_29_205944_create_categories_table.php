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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->unsignedBigInteger('category_parent_id')->nullable(); // Внешний ключ для родительской категории
            $table->foreign('category_parent_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('SEO_title')->nullable();
            $table->string('SEO_description')->nullable();
            $table->string('SEO_Keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
