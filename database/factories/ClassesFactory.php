<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\School;
use App\Models\Classes;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    protected $model = Classes::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_name' => fake()->randomElement(['Form 1', 'Form 2', 'Form 3', 'Form 4']),
            'year' => fake()->randomElement(['2021', '2022', '2023']),
            'school_id' => School::factory()->create()->id,
            'class_teacher' => Employee::factory()->create()->id
        ];
    }
}
