<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(config('filament-cms.features.posts') && config('filament-cms.features.category')) {
            Schema::create('posts_has_tags', function (Blueprint $table) {
                $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
                $table->foreignId('tag_id')->constrained('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('posts_has_tags');
        Schema::enableForeignKeyConstraints();
    }
};
