<?php

namespace Database\Factories;

use App\Enums\MerchantTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
 */
class MerchantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = $this->faker->url();
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'merchant_type' => MerchantTypeEnum::cases()[array_rand(MerchantTypeEnum::cases())]->value,
            'app_key' => Str::random(),
            'callback_url' => $url,
            'host_url' => parse_url($url, PHP_URL_HOST),
        ];
    }
}
