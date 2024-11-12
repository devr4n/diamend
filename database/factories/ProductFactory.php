<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\OperationType;
use App\Models\MaterialType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::pluck('id')->random(),
            'operation_type_id' => OperationType::pluck('id')->random(),
            'product_type_id' => ProductType::pluck('id')->random(),
            'description' => $this->faker->text,
            'weight' => $this->faker->randomFloat(2, 0, 1000),
            'image' => $this->faker->imageUrl(),
            'receive_date' => $this->faker->dateTimeThisYear(),
            'due_date' => $this->faker->dateTimeThisYear(),
            'delivery_date' => $this->faker->dateTimeThisYear(),
            'price' => $this->faker->numberBetween(100, 1000),
            'note' => $this->faker->text,
            'material_type_id' => MaterialType::pluck('id')->random(),
            'material_weight' => $this->faker->randomFloat(2, 0, 1000),
            'status_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
