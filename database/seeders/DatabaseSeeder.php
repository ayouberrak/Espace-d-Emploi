<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Create 10 Developers with Profiles
        $developers = \App\Models\User::factory()
            ->count(10)
            ->developer()
            ->create();

        $developers->each(function ($user) {
            \App\Models\Profil::factory()->create([
                'user_id' => $user->id
            ]);
        });
            
        // 2. Create 5 Recruiters, each with an Enterprise and 7 Offers (Total 35 offers)
        User::factory()
            ->count(5)
            ->recruiter()
            ->create()
            ->each(function ($user) {
                // Create Enterprise for this recruiter
                $entreprise = \App\Models\Entreprise::factory()->create([
                    'recruiter_id' => $user->id
                ]);

                // Create 7 Offers for this enterprise
                \App\Models\Offres::factory()->count(7)->create([
                    'enptrise_id' => $entreprise->id, // Note typo in migration
                    'recruiter_id' => $user->id
                ]);
            });
            
        // Optional: Create a test user for login if needed
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'devloppeur',
            'password' => Hash::make('password'),
        ]);
        
         User::factory()->create([
            'name' => 'Test Recruiter',
            'email' => 'recruiter@example.com',
            'role' => 'recruiter',
            'password' => Hash::make('password'),
        ]);
    }
}