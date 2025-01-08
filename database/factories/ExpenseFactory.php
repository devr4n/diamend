<?php

namespace Database\Factories;

use App\Models\ExpenseType;
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
        $expenseTypes = ExpenseType::all()->pluck('id')->toArray();
        return [
            'expense_type_id' => $this->faker->randomElement($expenseTypes),
            'amount' => $this->faker->numberBetween( 100, 10000),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'note' => $this->faker->text(),
        ];
    }
}
