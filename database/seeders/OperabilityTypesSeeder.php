<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OperabilityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('operability_types')->insert([
            'description' => 'Disponible',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('operability_types')->insert([
            'description' => 'Fuera de Servicio',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('operability_types')->insert([
            'description' => 'Inoperativo',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
