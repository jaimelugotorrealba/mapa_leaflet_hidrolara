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
            $table->unsignedBigInteger('system_id')->after('details')->nullable();
            $table->foreign('system_id')->references('id')->on('systems');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('operabilities', function (Blueprint $table) {
            $table->dropColumn('system_id');
        });
    }
};
