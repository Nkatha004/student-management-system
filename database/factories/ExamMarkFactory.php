<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\StudentSubject;
use App\Models\ExamMark;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamMark>
 */
class ExamMarkFactory extends Factory
{
    protected $model = ExamMark::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_subject_id' => StudentSubject::factory() -> create() -> id,
            'term' => fake()->randomElement(['First Term', 'Second Term', 'Third Term']),
            'year' => fake()->randomElement(['2021', '2022', '2023']),
            'mark' => fake()->numberBetween(40, 100),
            'added_by' => Employee::factory() -> create() -> id,
        ];
    }
}
