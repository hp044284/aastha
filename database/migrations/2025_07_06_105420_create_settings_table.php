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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->text('Value')->nullable();
            $table->enum('Type', ['text', 'password', 'checkbox', 'radio', 'select', 'textarea', 'file', 'number', 'email', 'url', 'year'])->nullable();
            $table->integer('Sort_Order')->default(1);
            $table->boolean('Status')->nullable()->default(true);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
