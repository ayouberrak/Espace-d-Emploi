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
        $companies = [
            ['Google', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/768px-Google_%22G%22_logo.svg.png'],
            ['Microsoft', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Microsoft_logo.svg/2048px-Microsoft_logo.svg.png'],
            ['Spotify', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Spotify_logo_without_text.svg/2048px-Spotify_logo_without_text.svg.png'],
            ['Amazon', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/2560px-Amazon_logo.svg.png'],
            ['Netflix', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Netflix_2015_logo.svg/2560px-Netflix_2015_logo.svg.png'],
            ['Apple', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Apple_logo_black.svg/1667px-Apple_logo_black.svg.png'],
            ['Tesla', 'https://upload.wikimedia.org/wikipedia/commons/e/e8/Tesla_logo.png'],
            ['Meta', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Meta_Platforms_Inc._logo.svg/2560px-Meta_Platforms_Inc._logo.svg.png'],
            ['Airbnb', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/2560px-Airbnb_Logo_B%C3%A9lo.svg.png'],
            ['Uber', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Uber_logo_2018.png/1200px-Uber_logo_2018.png'],
            ['Adobe', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/Adobe_Corporate_logo.svg/2560px-Adobe_Corporate_logo.svg.png'],
            ['Oracle', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Oracle_logo.svg/2560px-Oracle_logo.svg.png'],
        ];

        $company = fake()->randomElement($companies);

        return [
            'nom' => $company[0],
            'logo' => $company[1],
            'description' => fake()->paragraph(),
            'location' => fake()->randomElement(['Casablanca', 'Rabat', 'Marrakech', 'Tanger', 'Remote', 'Paris', 'Dubai']),
            'recruiter_id' => User::factory()->state(['role' => 'recruiter']),
            'create' => now(), 
        ];
    }
}
