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
        Schema::table('operabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('water_supply_infrastructure_id')->after('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('operabilities', function (Blueprint $table) {
            $table->dropColumn('water_supply_infrastructure_id');
        });
    }
};
