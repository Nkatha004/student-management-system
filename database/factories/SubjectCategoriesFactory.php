<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SubjectCategories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectCategories>
 */
class SubjectCategoriesFactory extends Factory
{
    protected $model = SubjectCategories::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_name' => fake()->randomElement(['Mathematics', 'Languages', 'Sciences', 'Humanities', 'Technicals']),
            'description' => fake()->text(10)
        ];
    }
}
