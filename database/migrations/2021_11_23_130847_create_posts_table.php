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
        if(config('filament-cms.features.posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();

                //Ref
                $table->unsignedBigInteger('author_id')->nullable();
                $table->string('author_type')->nullable();

                $table->string('type')->default('post')->nullable();

                //Info
                $table->json('title');
                $table->string('slug')->unique()->index();

                $table->json('short_description')->nullable();
                $table->json('keywords')->nullable();

                $table->json('body')->nullable();

                //Options
                $table->boolean('is_published')->default(0);
                $table->boolean('is_trend')->default(0);
                $table->dateTime('published_at')->nullable();

                //Counters
                $table->double('likes')->default(0);
                $table->double('views')->default(0);

                //Meta
                $table->string('meta_url')->nullable();
                $table->json('meta')->nullable();
                $table->text('meta_redirect')->nullable();

                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
};
