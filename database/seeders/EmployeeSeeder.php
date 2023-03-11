<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'gender' => 'male',
            'telephone_number' => fake()->numerify('0#########'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' => Role::IS_SUPERADMIN
        ]);
        Employee::create([
            'first_name' => 'Cynthia',
            'last_name' => 'Muiruri',
            'email' => 'cynthia@gmail.com',
            'tsc_number' => fake()->numerify('########'),
            'telephone_number' => fake()->numerify('0#########'),
            'gender' => 'female',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'school_id'=>1,
            'role_id' => Role::IS_PRINCIPAL
        ]);
        Employee::create([
            'first_name' => 'Mary',
            'last_name' => 'Wangui',
            'email' => 'mary@gmail.com',
            'tsc_number' => fake()->numerify('########'),
            'telephone_number' => fake()->numerify('0#########'),
            'gender' => 'female',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'school_id'=>1,
            'role_id' => Role::IS_CLASSTEACHER
        ]);
        Employee::create([
            'first_name' => 'Sam',
            'last_name' => 'Ongeri',
            'email' => 'sam@gmail.com',
            'tsc_number' => fake()->numerify('########'),
            'telephone_number' => fake()->numerify('0#########'),
            'gender' => 'male',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'school_id'=>1,
            'role_id' => Role::IS_TEACHER
        ]);
    }
}
