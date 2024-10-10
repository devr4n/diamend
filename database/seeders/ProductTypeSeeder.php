<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_types')->insert([
            ['name_tr' => 'Altın', 'name_en' => 'Gold'],
            ['name_tr' => 'Gümüş', 'name_en' => 'Silver'],
            ['name_tr' => 'Pırlanta', 'name_en' => 'Diamond'],
            ['name_tr' => 'İmitasyon', 'name_en' => 'Imitation'],
            ['name_tr' => 'Saat', 'name_en' => 'Watch'],
            ['name_tr' => 'Diğer', 'name_en' => 'Other'],
        ]);
    }
}
