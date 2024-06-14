<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(config('filament-cms.features.category')) {
            Schema::create('categories_metas', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('model_id')->nullable();
                $table->string('model_type')->nullable();

                $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');

                $table->string('key')->index();
                $table->json('value')->nullable();

                $table->timestamps();
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
        Schema::dropIfExists('categories_metas');
        Schema::enableForeignKeyConstraints();
    }
};
