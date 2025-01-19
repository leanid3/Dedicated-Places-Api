<?php

use App\Models\Category;
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
            $table->id('category_id');
            $table->foreignIdFor(Category::class, 'category_parent_id')->nullable();
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
