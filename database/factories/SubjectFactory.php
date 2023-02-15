<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SubjectCategories;
use App\Models\Subject;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    protected $model = Subject::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject_name' => fake()->randomElement(['Mathematics', 'English','Kiswahili', 'Chemistry', 'Biology', 'Physics', 'History', 'Geography', 'C.R.E', 'Business', 'Agriculture', 'French', 'Music', 'Aviation', 'HomeScience', 'Computer']),
            'category_id' => SubjectCategories::factory() -> create() -> id
        ];
    }
}
