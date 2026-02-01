<?php

namespace Database\Factories;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->jobTitle(),
            'bio' => fake()->paragraph(),
            'skills' => fake()->randomElements(['PHP', 'Laravel', 'Vue.js', 'React', 'Angular', 'Node.js', 'Python', 'Java', 'Docker'], 3),
            'experiances' => [
                [
                    'role' => fake()->jobTitle(),
                    'company' => fake()->company(),
                    'duration' => fake()->year() . ' - Present',
                    'description' => fake()->sentence(),
                ]
            ],
            'projects' => [
                [
                    'title' => fake()->catchPhrase(),
                    'description' => fake()->sentence(),
                    'link' => fake()->url(),
                ]
            ],
        ];
    }
}
