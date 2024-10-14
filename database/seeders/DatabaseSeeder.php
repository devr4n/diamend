<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CustomerSeeder::class,
            MaterialTypeSeeder::class,
            ProductTypeSeeder::class,
            OperationTypeSeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);
    }
}
