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
            User::factory()->recruiter()->create();
            User::factory()->developer()->create();

        } catch (\Exception $e) {
            $this->command->error($e->getMessage());
        }
    }
}
