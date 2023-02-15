<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PaypalPayment;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaypalPayment>
 */
class PaypalPaymentFactory extends Factory
{
    protected $model = PaypalPayment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_id' => fake()->regexify('[A-Za-z0-9]{14}'),
            'payer_id' => fake()->numerify('###-######'),
            'payer_email' => fake()->email,
            'amount' => 39.94,
            'currency'=> 'USD',
            'payment_status' => 'Approved',
            'paid_by' => Employee::factory()->create()->id
        ];
    }
}