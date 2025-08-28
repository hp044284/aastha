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
        Schema::create('testimonials', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->unsignedTinyInteger('ratting')->nullable();
            $table->text('message')->nullable();
            $table->string('treatment')->nullable(); // "treatment" is spelled correctly
            $table->boolean('status')->default(true)->nullable();
            $table->date('treatment_date')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
