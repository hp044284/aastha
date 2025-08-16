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
        Schema::create('featured_services', function (Blueprint $table) 
        {
            $table->id();
            $table->string('title')->comment('Title for the service');
            $table->string('slug')->nullable()->comment('Slug for the service');
            $table->string('sub_title')->nullable()->comment('Sub title for the service');
            $table->string('short_description')->nullable()->comment('Short description for the service');
            $table->string('url')->nullable()->comment('Url for the service');
            $table->string('file_name')->nullable()->comment('Image for the service');
            $table->string('status')->default(1)->nullable()->comment('Status for the service');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_services');
    }
};
