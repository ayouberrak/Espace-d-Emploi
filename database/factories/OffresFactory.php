<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\Offres;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offres>
 */
class OffresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enptrise_id' => Entreprise::factory(),
            'recruiter_id' => User::factory()->state(['role' => 'recruiter']),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'ofres_type' => fake()->randomElement(['Stage', 'CDI', 'CDD']),
            'durre' => fake()->randomElement(['3 mois', '6 mois', '1 an', 'Indéterminé']),
            'created_at' => now(),
            'candidat' => [], 
        ];
    }
}
