<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExamMark;
use App\Models\Classes;
use App\Models\Employee;
use App\Models\EmployeeSubject;
use App\Models\School;
use App\Models\MpesaPayment;
use App\Models\PaypalPayment;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\SubjectCategories;
use App\Models\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'id'=>1,
            'role_name' => 'Super Admin',
            'role_description' => 'Has access to entire system'
        ]);

        Role::factory()->create([
            'id'=> 2,
            'role_name' => 'Principal',
            'role_description' => 'This is the head of the school'
        ]);

        Role::factory()->create([
            'id'=> 3,
            'role_name' => 'Teacher',
            'role_description' => 'This is a normal classroom teacher'
        ]);

        Role::factory()->create([
            'id'=> 4,
            'role_name' => 'Class Teacher',
            'role_description' => 'He/she is incharge of a class'
        ]);

        Employee::factory()->create([
            'id'=>1,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'telephone_number' => fake()->numerify('0#########'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' => 1
        ]);
        ExamMark::factory(1)->create();
        Classes::factory(1)->create();
        Employee::factory(1)->create();
        EmployeeSubject::factory(1)->create();
        School::factory(1)->create();
        MpesaPayment::factory(5)->create();
        PaypalPayment::factory(5)->create();
        // Role::factory(1)->create();
        Student::factory(1)->create();
        StudentSubject::factory(1)->create();
        SubjectCategories::factory(1)->create();
        Subject::factory(1)->create();
    }
}
