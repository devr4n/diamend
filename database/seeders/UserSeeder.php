<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'devran',
            'last_name' => 'devran',
            'email' => 'd@d.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
