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
        if(config('filament-cms.features.posts')) {
            Schema::create('post_metas', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('model_id')->nullable();
                $table->string('model_type')->nullable();

                $table->foreignId('post_id')->references('id')->on('posts')->onDelete('cascade');

                $table->string('key')->index();
                $table->json('value')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('post_metas');
        Schema::enableForeignKeyConstraints();
    }
};
