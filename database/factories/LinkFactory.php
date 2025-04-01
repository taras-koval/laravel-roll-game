<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'uuid' => Str::uuid(),
            'active' => true,
            'created_at' => now(),
        ];
    }

    public function withCreatedDaysAgo(int $daysAgo): self
    {
        return $this->state(function () use ($daysAgo) {
            return [
                'created_at' => now()->subDays($daysAgo),
                'updated_at' => now()->subDays($daysAgo),
            ];
        });
    }
}
