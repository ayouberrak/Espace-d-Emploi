<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RecruteurSeeder extends Seeder
{
    public function run(): void
    {
        $recruteurs = [
            [
                'name' => 'Ahmed Bennani',
                'email' => 'ahmed.bennani@techcorp.ma',
                'password' => Hash::make('password123'),
                'role' => 'recruiter',
                'photo' => 'photos/ahmed.jpg',
                'bio' => 'Recruteur senior avec 8 ans d\'expérience dans le secteur IT.',
                'phone' => '+212 6 12 34 56 78',
                'amis' => json_encode([]),
            ],
            [
                'name' => 'Fatima Alaoui',
                'email' => 'fatima.alaoui@digitalminds.ma',
                'password' => Hash::make('password123'),
                'role' => 'recruiter',
                'photo' => 'photos/fatima.jpg',
                'bio' => 'Responsable RH passionnée par le recrutement tech.',
                'phone' => '+212 6 23 45 67 89',
                'amis' => json_encode([]),
            ],
            [
                'name' => 'Youssef Idrissi',
                'email' => 'youssef.idrissi@innovatetech.ma',
                'password' => Hash::make('password123'),
                'role' => 'recruiter',
                'photo' => 'photos/youssef.jpg',
                'bio' => 'Spécialiste en recrutement de profils data et IA.',
                'phone' => '+212 6 34 56 78 90',
                'amis' => json_encode([]),
            ],
            [
                'name' => 'Nadia El Fassi',
                'email' => 'nadia.elfassi@cloudsystems.ma',
                'password' => Hash::make('password123'),
                'role' => 'recruiter',
                'photo' => 'photos/nadia.jpg',
                'bio' => 'Recruteur tech avec expertise en cloud et DevOps.',
                'phone' => '+212 6 45 67 89 01',
                'amis' => json_encode([]),
            ],
            [
                'name' => 'Omar Tazi',
                'email' => 'omar.tazi@webfactory.ma',
                'password' => Hash::make('password123'),
                'role' => 'recruiter',
                'photo' => 'photos/omar.jpg',
                'bio' => 'Recruteur spécialisé dans les profils créatifs et web.',
                'phone' => '+212 6 56 78 90 12',
                'amis' => json_encode([]),
            ],
            [
                'name' => 'Samira Benjelloun',
                'email' => 'samira.benjelloun@datahub.ma',
                'password' => Hash::make('password123'),
                'role' => 'recruiter',
                'photo' => 'photos/samira.jpg',
                'bio' => 'Expert en recrutement de data scientists et analystes.',
                'phone' => '+212 6 67 89 01 23',
                'amis' => json_encode([]),
            ],
        ];

        foreach ($recruteurs as $recruteur) {
            User::create($recruteur);
        }

        $this->command->info('6 recruteurs ont été créés avec succès!');
    }
}
