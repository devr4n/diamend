<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expense_type_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'date' => $this->faker->date(),
            'note' => $this->faker->text(),
        ];
    }
}
