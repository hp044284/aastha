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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Email')->nullable();
            $table->string('Name')->nullable();
            $table->string('Mobile', 20)->nullable();
            $table->text('Message')->nullable();
            $table->string('Random_Id', 10)->nullable();
            $table->boolean('Status')->nullable()->default(true);
            $table->boolean('Is_Deleted')->nullable()->default(false);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
