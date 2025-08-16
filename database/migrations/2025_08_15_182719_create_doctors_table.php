<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable()->comment('Profile image');
            $table->string('position_id')->nullable();
            $table->string('affiliation')->nullable();
            $table->boolean('status')->default(1);
            $table->text('about_us')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
