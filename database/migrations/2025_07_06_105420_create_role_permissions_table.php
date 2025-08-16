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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->boolean('Status')->default(true);
            $table->integer('Role_Id')->index('site_permissions_roles_fk')->comment('this is primary id for roles table');
            $table->boolean('Is_Add')->default(false);
            $table->boolean('Is_Edit')->default(false);
            $table->boolean('Is_Read')->default(false);
            $table->boolean('Is_Delete')->default(false);
            $table->integer('Permission_Id')->default(0)->index('site_permissions_managers_fk');
            $table->tinyInteger('Sort_Order')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
