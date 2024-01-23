<?php

namespace Database\Factories;

use App\Enums\GeneralPaymentStatus;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => GeneralPaymentStatus::CREATED,
            'amount' => $this->faker->randomNumber(),
            'merchant_id' => Merchant::query()->inRandomOrder()->first()->id,
        ];
    }
}
