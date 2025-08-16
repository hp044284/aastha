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
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Title')->nullable();
            $table->string('Sub_Title')->nullable();
            $table->string('Slider_Url')->nullable();
            $table->string('File_Name')->nullable();
            $table->string('Random_Id', 30)->nullable();
            $table->tinyText('Short_Description')->nullable();
            $table->boolean('Is_Deleted')->default(false);
            $table->boolean('Status')->default(true);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
