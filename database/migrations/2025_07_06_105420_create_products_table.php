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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Tags')->nullable();
            $table->string('Sku')->nullable();
            $table->string('Slug')->nullable();
            $table->decimal('Price', 10)->nullable()->default(0);
            $table->decimal('Old_Price', 10)->nullable()->default(0);
            $table->integer('Quntity')->nullable()->default(0);
            $table->string('Meta_Title')->nullable();
            $table->string('File_Name')->nullable();
            $table->string('Random_Id', 10)->nullable();
            $table->text('Description')->nullable();
            $table->string('Meta_Keyword')->nullable();
            $table->string('Product_Name')->nullable();
            $table->text('Meta_Description')->nullable();
            $table->text('Short_Description')->nullable();
            $table->text('Aditional_Description')->nullable();
            $table->integer('Product_Category_Id')->nullable()->default(0);
            $table->integer('Product_Sub_Category_Id')->nullable()->default(0);
            $table->integer('Review_Count')->nullable()->default(0);
            $table->float('Avg_Rating')->nullable();
            $table->boolean('Status')->nullable()->default(true);
            $table->boolean('Is_Deleted')->nullable()->default(false);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
