<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['devloppeur', 'recruiter']),
            'photo' => 'https://i.pravatar.cc/150?u=' . fake()->unique()->numberBetween(1, 10000),
            'cover_image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/600/200',
            'bio' => fake()->paragraph(),
            'phone' => fake()->phoneNumber(),
            'amis' => [], 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function recruiter(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'recruiter',
        ]);
    }

    public function developer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'devloppeur',
        ]);
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            if ($user->role === 'recruiter') {
                 \App\Models\Entreprise::factory()->create([
                    'recruiter_id' => $user->id,
                ]);
            } elseif ($user->role === 'devloppeur') {
                 \App\Models\Profil::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
