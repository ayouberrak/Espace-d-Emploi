<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\Offres;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


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
            'competences' => fake()->randomElements(['PHP', 'Laravel', 'React', 'Vue.js', 'Angular', 'Node.js', 'Python', 'Java', 'Docker', 'AWS', 'Figma', 'UI/UX'], rand(3, 6)),
            'created_at' => now(),
            'candidat' => [], 
        ];
    }
}
