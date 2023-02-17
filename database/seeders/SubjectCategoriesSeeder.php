<?php

namespace Database\Seeders;

use App\Models\SubjectCategories;
use Illuminate\Database\Seeder;


class SubjectCategoriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        SubjectCategories::create(['category_name' => 'Mathematics', 'description' => 'Includes Math SubjectCategories']);
        SubjectCategories::create(['category_name' => 'Languages', 'description' => 'Includes English and Kiswahili']);
        SubjectCategories::create(['category_name' => 'Sciences', 'description' => 'Includes Chemistry, Biology and Physics']);
        SubjectCategories::create(['category_name' => 'Humanities','description' => 'Includes Geography, History and C.R.E']);
        SubjectCategories::create(['category_name' => 'Technicals', 'description' => 'Includes practical subjects']);
    }
}