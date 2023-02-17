<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Classes;
use Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'admission_number' => fake()->numerify('#####'),
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'guardian_name' => fake()->name,
            'guardian_phone_number' => fake()->numerify('0#########'),
            'guardian_email' => fake()->email(),
            'class_id' => 1,
        ];
    }
}
