<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory()->count(15)->create();
        Customer::create([
            'name' => 'devran',
            'surname' => 'devran',
            'phone_1' => '123456789',
            'address' => 'nicosia'
        ]);
    }
}
