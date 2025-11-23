<?php

namespace Database\Factories;

use App\Models\MsClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MsClass>
 */
class MsClassFactory extends Factory
{
    protected $model = MsClass::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true) . ' Class',
            'description' => fake()->sentence(),
            'instructor' => fake()->name(),
        ];
    }
}

