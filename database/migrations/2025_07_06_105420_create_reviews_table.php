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
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name')->nullable();
            $table->string('Email')->nullable();
            $table->string('Website')->nullable();
            $table->text('Message')->nullable();
            $table->boolean('Is_Save')->nullable()->default(false);
            $table->integer('Blog_Id')->nullable()->default(0);
            $table->integer('Product_Id')->nullable()->default(0);
            $table->integer('Parent_Id')->nullable()->default(0);
            $table->string('Random_Id', 10)->nullable();
            $table->float('Rating')->nullable()->default(0);
            $table->string('Mobile', 30)->nullable();
            $table->boolean('Status')->nullable()->default(true);
            $table->enum('Review_Status', ['Pending', 'Approved', 'Rejected'])->nullable()->default('Pending');
            $table->enum('Review_Type', ['Blog', 'Product'])->nullable()->default('Blog');
            $table->boolean('Is_Deleted')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
