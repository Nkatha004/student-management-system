<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Classes::create([
            'class_name' => 'Form 1',
            'year' => 2023,
            'school_id' => 1,
            'class_teacher' => 3
        ]);
    }
}
