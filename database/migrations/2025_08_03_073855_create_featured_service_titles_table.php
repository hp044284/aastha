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
        Schema::create('featured_service_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Title for the service');
            $table->foreignId('featured_service_id')->constrained('featured_services')->onDelete('cascade')->comment('Featured service id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_service_titles');
    }
};
