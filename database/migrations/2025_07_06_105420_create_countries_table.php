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
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('East', 30)->nullable();
            $table->string('West', 30)->nullable();
            $table->string('North', 30)->nullable();
            $table->string('South', 30)->nullable();
            $table->string('Capital', 100)->nullable();
            $table->char('Fips_Code', 2)->nullable();
            $table->string('Continent_Name', 100)->nullable();
            $table->char('Continent', 2)->nullable();
            $table->char('Iso_Alpha3', 3)->nullable();
            $table->string('Languages', 100)->nullable();
            $table->integer('Geoname_Id')->nullable();
            $table->char('Iso_Numeric', 4)->nullable();
            $table->char('Country_Code', 2);
            $table->string('Country_Name', 100);
            $table->char('Currency_Code', 3)->nullable();
            $table->string('Telephone_Prefix', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
