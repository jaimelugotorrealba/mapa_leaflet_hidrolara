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
        Schema::create('description_operabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operability_type_id');
            $table->string('description');
            $table->char('status',1)->default('A');
            $table->foreign('operability_type_id')->references('id')->on('operability_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_operability_statuses');
    }
};
