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
            Schema::table('form_options', function (Blueprint $table) {
                $table->foreignId('sub_form')->nullable()->constrained('forms');
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
        if(config('filament-cms.features.forms')) {
            Schema::table('form_options', function (Blueprint $table) {
                $table->dropForeign(['sub_form']);
                $table->dropColumn('sub_form');
            });
        }
    }
};
