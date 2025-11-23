<?php

namespace Database\Factories;

use App\Models\MsMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MsMember>
 */
class MsMemberFactory extends Factory
{
    protected $model = MsMember::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('##########'), // 10 digits
            'address' => fake()->address(),
        ];
    }
}

