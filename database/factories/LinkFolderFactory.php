<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFolderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'name' => fake()->unique()->words(2, true),
            'color' => 'zinc',
            'position' => 0,
        ];
    }
}
