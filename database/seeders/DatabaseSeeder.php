<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTypesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(IconsSeeder::class);
        $this->call(OperabilityTypesSeeder::class);
        $this->call(DescriptionOperabilitiesSeeder::class);
    }
}
