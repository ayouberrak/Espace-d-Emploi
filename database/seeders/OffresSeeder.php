<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offres;
use App\Models\Entreprise;
use App\Models\User;

class OffresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entreprises = Entreprise::all();
        $recruteurs = User::where('role', 'recruiter')->get();

        if ($entreprises->isEmpty() || $recruteurs->isEmpty()) {
            $this->command->info('Veuillez d\'abord créer des entreprises et des recruteurs.');
            return;
        }

        $offres = [
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Développeur Full Stack',
                'description' => 'Nous recherchons un développeur Full Stack expérimenté pour rejoindre notre équipe. Compétences requises: Laravel, Vue.js, MySQL.',
                'ofres_type' => 'CDI',
                'durre' => 'Permanent',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Stage en Développement Web',
                'description' => 'Offre de stage de 6 mois pour étudiant en informatique. Formation sur les technologies web modernes.',
                'ofres_type' => 'Stage',
                'durre' => '6 mois',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Chef de Projet IT',
                'description' => 'Recherche chef de projet expérimenté pour gérer des projets de transformation digitale.',
                'ofres_type' => 'CDD',
                'durre' => '12 mois',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Développeur Mobile Flutter',
                'description' => 'Développeur mobile pour créer des applications iOS et Android avec Flutter.',
                'ofres_type' => 'CDI',
                'durre' => 'Permanent',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Data Scientist',
                'description' => 'Analyste de données pour travailler sur des projets de machine learning et d\'analyse prédictive.',
                'ofres_type' => 'CDI',
                'durre' => 'Permanent',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Stage en Marketing Digital',
                'description' => 'Stage de 3 mois en marketing digital. Gestion des réseaux sociaux et campagnes publicitaires.',
                'ofres_type' => 'Stage',
                'durre' => '3 mois',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Ingénieur DevOps',
                'description' => 'Ingénieur DevOps pour automatiser les déploiements et gérer l\'infrastructure cloud.',
                'ofres_type' => 'CDD',
                'durre' => '18 mois',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Designer UX/UI',
                'description' => 'Designer créatif pour concevoir des interfaces utilisateur modernes et intuitives.',
                'ofres_type' => 'CDI',
                'durre' => 'Permanent',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Développeur PHP/Laravel',
                'description' => 'Développeur backend expérimenté en PHP et Laravel pour développer des applications web robustes.',
                'ofres_type' => 'CDI',
                'durre' => 'Permanent',
                'created_at' => now(),
            ],
            [
                'enptrise_id' => $entreprises->random()->id,
                'recruiter_id' => $recruteurs->random()->id,
                'title' => 'Stage en Développement Mobile',
                'description' => 'Stage de 4 mois pour développer des applications mobiles natives.',
                'ofres_type' => 'Stage',
                'durre' => '4 mois',
                'created_at' => now(),
            ],
        ];

        foreach ($offres as $offre) {
            Offres::create($offre);
        }

        $this->command->info('10 offres ont été créées avec succès!');
    }
}
