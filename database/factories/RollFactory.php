<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Roll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Roll>
 */
class RollFactory extends Factory
{
    public function definition(): array
    {
        $number = $this->faker->numberBetween(1, 1000);
        $win = $number % 2 === 0;
        $amount = $win ? (int) round($number * 0.3) : 0;

        return [
            'link_id' => Link::factory(),
            'number' => $number,
            'win' => $win,
            'amount' => $amount,
        ];
    }
}
