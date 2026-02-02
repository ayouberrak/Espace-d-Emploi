<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Added Hash facade import

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Create 1 recruiter
            User::factory()->recruiter()->create();
            $this->command->info('Recruiter created successfully.');

             // Create 1 developer
            User::factory()->developer()->create();
            $this->command->info('Developer created successfully.');

        } catch (\Exception $e) {
            $this->command->error($e->getMessage());
        }
    }
}
