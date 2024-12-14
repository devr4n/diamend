<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenseType::create([
            'name_tr' => 'Elektrik',
            'name_en' => 'Electricity',
            'description_tr' => 'Elektrik faturası',
            'description_en' => 'Electricity bill',
            'color' => '#FFD700',
        ]);

        ExpenseType::create([
            'name_tr' => 'Su',
            'name_en' => 'Water',
            'description_tr' => 'Su faturası',
            'description_en' => 'Water bill',
            'color' => '#87CEEB',
        ]);

        ExpenseType::create([
            'name_tr' => 'Mutfak',
            'name_en' => 'Kitchen',
            'description_tr' => 'Mutfak masrafları',
            'description_en' => 'Kitchen expenses',
            'color' => '#98FB98',
        ]);

        ExpenseType::create([
            'name_tr' => 'Diğer',
            'name_en' => 'Other',
            'description_tr' => 'Diğer masraflar',
            'description_en' => 'Other expenses',
            'color' => '#D3D3D3',
        ]);
    }
}
