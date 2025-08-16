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
        Schema::create('doctor_affiliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // Relation to doctors table
            $table->string('organization'); // e.g. Aastha Hospital
            $table->string('affiliation_type')->nullable(); // e.g. Primary Affiliation
            $table->string('role_title')->nullable(); // e.g. Director, Neonatal ICU & Senior Consultant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_affiliations');
    }
};
