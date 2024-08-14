<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('icons')->insert([
            'description' => 'Bombillo',
            'icon' => '<i class="fas fa-lightbulb"></i>',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('icons')->insert([
            'description' => 'Agua',
            'icon' => '<i class="fas fa-water"></i>',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('icons')->insert([
            'description' => 'Camión',
            'icon' => '<i class="fas fa-truck"></i>',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('icons')->insert([
            'description' => 'Edificio',
            'icon' => '<i class="fas fa-building"></i>',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('icons')->insert([
            'description' => 'Ubicación',
            'icon' => '<i class="fas fa-map-marker-alt"></i>',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('icons')->insert([
            'description' => 'Árbol',
            'icon' => '<i class="fas fa-tree"></i>',
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
