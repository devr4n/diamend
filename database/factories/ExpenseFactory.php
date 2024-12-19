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
            'expense_type_id' => $this->faker->numberBetween(1, 4),
            'amount' => $this->faker->numberBetween(2, 10000),
            'date' => $this->faker->dateTimeThisYear(),
            'note' => $this->faker->text(),
        ];
    }
}
