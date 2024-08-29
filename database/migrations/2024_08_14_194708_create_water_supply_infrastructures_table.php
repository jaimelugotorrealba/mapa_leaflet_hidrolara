<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('water_supply_infrastructures', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        $sqls = [
            [
                'description' => 'Captación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Potabilización',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Producción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Conducción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Distribución',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        DB::table('water_supply_infrastructures')->insert($sqls);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_supply_infrastructures');
    }
};
