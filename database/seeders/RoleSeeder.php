<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role_name' => 'Super Admin', 'role_description' => 'Has access to entire system']);
        Role::create(['role_name' => 'Principal', 'role_description' => 'This is the head of the school']);
        Role::create(['role_name' => 'Class Teacher', 'role_description' => 'He/she is incharge of a class']);
        Role::create(['role_name' => 'Teacher','role_description' => 'This is a normal classroom teacher']);
    }
}
