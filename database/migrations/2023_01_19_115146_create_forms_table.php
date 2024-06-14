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
        if(config('filament-cms.features.forms')) {
            Schema::create('forms', function (Blueprint $table) {
                $table->id();

                //Set Type from page/modal/slideover
                $table->string('type')->default('page')->nullable();

                //Set Name And Key
                $table->json('title')->nullable();
                $table->json('description')->nullable();
                $table->string('key')->unique()->index();

                //Set Form Action
                $table->string('endpoint')->default('/')->nullable();
                $table->string('method')->default('POST')->nullable();

                //Form Control
                $table->boolean('is_active')->default(0)->nullable();

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
        Schema::dropIfExists('forms');
    }
};
