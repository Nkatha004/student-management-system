<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExamMark;
use App\Models\EmployeeSubject;
use App\Models\MpesaPayment;
use App\Models\PaypalPayment;
use App\Models\Classes;
use App\Models\Employee;
use App\Models\Role;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\SubjectCategories;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SubjectCategoriesSeeder::class,
            SubjectSeeder::class,
            RoleSeeder::class,
            SchoolSeeder::class,
            EmployeeSeeder::class,
            ClassesSeeder::class,
        ]);
        ExamMark::factory(10)->create();
        EmployeeSubject::factory()->create();
        MpesaPayment::factory(1)->create();
        PaypalPayment::factory(1)->create();
    }
}
