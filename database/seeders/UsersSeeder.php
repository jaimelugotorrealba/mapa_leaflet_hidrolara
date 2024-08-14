<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jaime Lugo',
            'email' => 'lugotorrealba@gmail.com',
            'password' => Hash::make('tormenta0012'),
            'status' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
