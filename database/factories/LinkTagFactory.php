<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LinkTagFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->word();

        return [
            'team_id' => Team::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
