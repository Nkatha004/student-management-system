<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\EmployeeSubject;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\Classes;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSubject>
 */
class EmployeeSubjectFactory extends Factory
{
    protected $model = EmployeeSubject::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory()->create()->id,
            'subject_id' => Subject::factory()->create()->id,
            'class_id' => Classes::factory()->create()->id
        ];
    }
}