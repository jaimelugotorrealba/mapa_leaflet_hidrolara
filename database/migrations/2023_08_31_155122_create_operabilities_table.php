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
        Schema::create('operabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('operability_type_id');
            $table->unsignedBigInteger('icon_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('parish_id');
            $table->string('details');
            $table->string('sector');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('capacity');
            $table->string('flow');
            $table->string('status_description');
            $table->text('observation')->nullable();
            $table->char('status',1)->default('A');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('operability_type_id')->references('id')->on('operability_types');
            $table->foreign('icon_id')->references('id')->on('icons');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('parish_id')->references('id')->on('parishes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operabilities');
    }
};
