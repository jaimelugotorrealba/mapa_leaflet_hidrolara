<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DescriptionOperabilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Status one
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 1,
            'description' => 'Funcionamiento en óptimas condiciones',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Status two
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 2,
            'description' => 'Fluctuación eléctrica',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 2,
            'description' => 'Plan de Administración de Carga SEN',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 2,
            'description' => 'Falla eléctrica',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 2,
            'description' => 'Programación de Servicio',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 2,
            'description' => 'Mantenimiento preventivo',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 2,
            'description' => 'Reparación de Aducción',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Status three
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 3,
            'description' => 'Motor',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 3,
            'description' => 'Bomba',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 3,
            'description' => 'Válvulas',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 3,
            'description' => 'Tablero de Control',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('description_operabilities')->insert([
            'operability_type_id' => 3,
            'description' => 'Banco de Transformadores',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
