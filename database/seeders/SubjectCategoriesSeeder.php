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
        SubjectCategories::create(['category_name' => 'Mathematics', 'description' => 'Includes Math SubjectCategories', 'school_id' => 1]);
        SubjectCategories::create(['category_name' => 'Languages', 'description' => 'Includes English and Kiswahili', 'school_id' => 1]);
        SubjectCategories::create(['category_name' => 'Sciences', 'description' => 'Includes Chemistry, Biology and Physics', 'school_id' => 1]);
        SubjectCategories::create(['category_name' => 'Humanities','description' => 'Includes Geography, History and C.R.E', 'school_id' => 1]);
        SubjectCategories::create(['category_name' => 'Technicals', 'description' => 'Includes practical subjects', 'school_id' => 1]);
    }
}