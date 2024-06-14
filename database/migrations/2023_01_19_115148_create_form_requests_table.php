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
        if(config('filament-cms.features.form_requests')) {
            Schema::create('form_requests', function (Blueprint $table) {
                $table->id();

                //Morph
                $table->string('model_type')->nullable();
                $table->unsignedBigInteger('model_id')->nullable();

                //Morph Service
                $table->string('service_type')->nullable();
                $table->unsignedBigInteger('service_id')->nullable();

                $table->foreignId('form_id')->constrained('forms');
                $table->string('status')->default('pending')->nullable();
                $table->json('payload')->nullable();

                $table->text('description')->nullable();
                $table->date('date')->nullable();
                $table->time('time')->nullable();

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
        Schema::dropIfExists('form_requests');
        Schema::enableForeignKeyConstraints();
    }
};
