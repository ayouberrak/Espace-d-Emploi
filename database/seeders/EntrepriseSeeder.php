<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entreprise;
use App\Models\User;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recruteurs = User::where('role', 'recruiter')->get();

        if ($recruteurs->isEmpty()) {
            $this->command->info('Veuillez d\'abord créer des recruteurs.');
            return;
        }

        $entreprises = [
            [
                'nom' => 'TechCorp Solutions',
                'logo' => 'logos/techcorp.png',
                'description' => 'Entreprise leader dans le développement de solutions logicielles innovantes.',
                'location' => 'Casablanca, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'Digital Minds',
                'logo' => 'logos/digitalminds.png',
                'description' => 'Agence digitale spécialisée dans le marketing et le développement web.',
                'location' => 'Rabat, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'InnovateTech',
                'logo' => 'logos/innovatetech.png',
                'description' => 'Startup tech focalisée sur l\'intelligence artificielle et le machine learning.',
                'location' => 'Marrakech, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'CloudSystems',
                'logo' => 'logos/cloudsystems.png',
                'description' => 'Fournisseur de services cloud et infrastructure IT.',
                'location' => 'Tanger, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'WebFactory',
                'logo' => 'logos/webfactory.png',
                'description' => 'Agence web créative spécialisée dans le design et le développement.',
                'location' => 'Fès, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'DataHub Analytics',
                'logo' => 'logos/datahub.png',
                'description' => 'Société de conseil en data science et business intelligence.',
                'location' => 'Casablanca, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'MobileDev Pro',
                'logo' => 'logos/mobiledev.png',
                'description' => 'Studio de développement d\'applications mobiles iOS et Android.',
                'location' => 'Rabat, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
            [
                'nom' => 'CyberSecure',
                'logo' => 'logos/cybersecure.png',
                'description' => 'Entreprise spécialisée en cybersécurité et protection des données.',
                'location' => 'Casablanca, Maroc',
                'recruiter_id' => $recruteurs->random()->id,
                'create' => now(),
            ],
        ];

        foreach ($entreprises as $entreprise) {
            Entreprise::create($entreprise);
        }

        $this->command->info('8 entreprises ont été créées avec succès!');
    }
}
