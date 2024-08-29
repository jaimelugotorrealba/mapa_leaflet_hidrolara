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
            $table->string('code')->after('id')->nullable();
            $table->string('utm_x')->after('sector')->nullable();
            $table->string('utm_y')->after('utm_x')->nullable();
            $table->string('zone')->after('utm_y')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('operabilities', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('utm_x');
            $table->dropColumn('utm_y');
            $table->dropColumn('zone');
        });
    }
};
