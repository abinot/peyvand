<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'created_by' => null,
            'code' => Str::random(8),
            'original_url' => fake()->url(),
            'title' => fake()->words(3, true),
            'clicks' => 0,
            'is_active' => true,
            'expires_at' => null,
            'metadata' => null,
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }

    public function expired(): static
    {
        return $this->state(['expires_at' => now()->subDay()]);
    }
}
