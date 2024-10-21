<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('operation_types')->insert([
            ['name_tr' => 'Tamir', 'name_en' => 'Repair'],
            ['name_tr' => 'Sipariş', 'name_en' => 'Order'],
        ]);
    }
}
