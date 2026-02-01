<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entreprise>
 */
class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->company(),
            'logo' => fake()->imageUrl(100, 100, 'business'),
            'description' => fake()->paragraph(),
            'location' => fake()->city(),
            'recruiter_id' => User::factory()->state(['role' => 'recruiter']),
            'create' => now(), 
        ];
    }
}
