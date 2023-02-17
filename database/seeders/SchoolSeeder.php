<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'school_name' => 'Kilimani High School',
            'email' => 'kilimani@school.edu',
            'phone_number' => fake()->numerify('0#########'),
            'payment_status' => 'Payment Complete'
        ]);
    }
}
