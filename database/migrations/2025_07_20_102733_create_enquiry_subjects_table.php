<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
	{
		Schema::create('cms_pages', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
			$table->longText('content')->nullable();
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->text('meta_keywords')->nullable();
			$table->string('og_title')->nullable();
			$table->text('og_description')->nullable();
			$table->string('og_image')->nullable();
			$table->string('canonical_url')->nullable();
			$table->enum('robots_index', ['index', 'noindex'])->default('index');
			$table->enum('robots_follow', ['follow', 'nofollow'])->default('follow');
			$table->text('schema_markup')->nullable();
			$table->boolean('status')->default(1);
			$table->timestamps();
		});
	}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_subjects');
    }
};
