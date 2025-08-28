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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('file_name')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('description')->nullable();
            $table->integer('category_id')->nullable()->default(0);
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
