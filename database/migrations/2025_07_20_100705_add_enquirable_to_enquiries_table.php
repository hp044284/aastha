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
        Schema::table('enquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('enquirable_id')->nullable()->after('Random_Id');
            $table->string('enquirable_type')->nullable()->after('enquirable_id');
            $table->string('subject')->nullable()->after('enquirable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn(['enquirable_id', 'enquirable_type', 'subject']);
        });
    }
};
