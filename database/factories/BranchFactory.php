<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'section_id' => Section::query()->inRandomOrder()->value('id'),
            'parent_id' => Branch::query()->inRandomOrder()->value('id') ?? null
        ];
    }
}
