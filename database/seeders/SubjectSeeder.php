<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\SubjectCategories;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['subject_name' => 'Mathematics', 'category_id' => SubjectCategories::MATHEMATICS, 'school_id' => 1]);

        Subject::create(['subject_name' => 'English', 'category_id' => SubjectCategories::LANGUAGES, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Kiswahili', 'category_id' => SubjectCategories::LANGUAGES, 'school_id' => 1]);

        Subject::create(['subject_name' => 'Chemistry','category_id' => SubjectCategories::SCIENCES, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Biology', 'category_id' => SubjectCategories::SCIENCES, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Physics','category_id' => SubjectCategories::SCIENCES, 'school_id' => 1]);

        Subject::create(['subject_name' => 'Geography', 'category_id' => SubjectCategories::HUMANITIES, 'school_id' => 1]);
        Subject::create(['subject_name' => 'History','category_id' => SubjectCategories::HUMANITIES, 'school_id' => 1]);
        Subject::create(['subject_name' => 'C.R.E', 'category_id' => SubjectCategories::HUMANITIES, 'school_id' => 1]);

        Subject::create(['subject_name' => 'Business','category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Computer', 'category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Home Science','category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Aviation', 'category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'French','category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Music','category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'German','category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
        Subject::create(['subject_name' => 'Agriculture','category_id' => SubjectCategories::TECHNICALS, 'school_id' => 1]);
    }
}
