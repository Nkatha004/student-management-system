<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MpesaPayment;
use App\Models\Employee;
use Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MpesaPayment>
 */
class MpesaPaymentFactory extends Factory
{
    protected $model = MpesaPayment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_id' => fake()->regexify('[A-Z0-9]{14}'),
            'transaction_date' => fake()->date(),
            'amount' => 5000,
            'currency' => 'KES',
            'phone_number' => fake()->numerify('0#########'),
            'paid_by' => 1
        ];
    }
}