<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('material_types')->insert([
            ['name_tr' => 'Altın 916', 'name_en' => 'Gold 916'],
            ['name_tr' => 'Altın 750', 'name_en' => 'Gold 750'],
            ['name_tr' => 'Altın 585', 'name_en' => 'Gold 585'],
            ['name_tr' => 'Gümüş', 'name_en' => 'Silver'],
        ]);
    }
}
