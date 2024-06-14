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
        if(config('filament-cms.features.comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('parent_id')->nullable();

                //Link User
                $table->unsignedBigInteger('user_id');
                $table->string('user_type');


                //Link Content
                $table->unsignedBigInteger('content_id');
                $table->string('content_type');

                //Body
                $table->longText('comment');
                $table->float('rate')->default(0)->nullable();

                //Options
                $table->boolean('is_active')->default(1)->nullable();

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
        Schema::dropIfExists('comments');
    }
};
