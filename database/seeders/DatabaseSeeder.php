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
        $usersData = [
            [
                'name'     => 'Sara Lahlou',
                'email'    => 'sara@youconnecte.ma',
                'password' => Hash::make('123456789'),
                'role'     => 'devloppeur',
                'photo'    => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Sara',
                'bio'      => 'Creative UI/UX Designer passionate about clean interfaces.',
                'phone'    => '+212 600 111 111',
                'skills'   => ['Figma', 'Adobe XD', 'Prototyping', 'User Research'],
                'exp'      => 'Senior Product Designer chez Creative Agency',
                'project_img' => 'https://images.unsplash.com/photo-1586717791821-3f44a563eb4c?w=800'
            ],
            [
                'name'     => 'Hamza Idrissi',
                'email'    => 'hamza@youconnecte.ma',
                'password' => Hash::make('123456789'),
                'role'     => 'devloppeur',
                'photo'    => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Hamza',
                'bio'      => 'Backend developer focused on PHP, Laravel & APIs.',
                'phone'    => '+212 600 222 222',
                'skills'   => ['PHP', 'Laravel', 'MySQL', 'Docker', 'Redis'],
                'exp'      => 'Lead Backend Developer chez TechSolutions',
                'project_img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800'
            ],
            [
                'name'     => 'Nadia Benali',
                'email'    => 'nadia@youconnecte.ma',
                'password' => Hash::make('123456789'),
                'role'     => 'devloppeur',
                'photo'    => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Nadia',
                'bio'      => 'Digital marketing specialist, SEO & Social Media.',
                'phone'    => '+212 600 333 333',
                'skills'   => ['SEO', 'Google Ads', 'Copywriting', 'Analytics'],
                'exp'      => 'Digital Strategist chez GrowthMedia',
                'project_img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800'
            ],
            [
                'name'     => 'Youssef Choukri',
                'email'    => 'youssef@youconnecte.ma',
                'password' => Hash::make('123456789'),
                'role'     => 'devloppeur',
                'photo'    => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Youssef',
                'bio'      => 'Frontend developer with a passion for React and Vue.',
                'phone'    => '+212 600 444 444',
                'skills'   => ['React', 'Vue.js', 'Tailwind CSS', 'TypeScript'],
                'exp'      => 'Frontend Engineer chez WebFlow Morocco',
                'project_img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800'
            ]
        ];

        foreach ($usersData as $u) {
            // Création de l'utilisateur
            $user = User::create([
                'name'     => $u['name'],
                'email'    => $u['email'],
                'password' => $u['password'],
                'role'     => $u['role'],
                'photo'    => $u['photo'],
                'phone'    => $u['phone'],
            ]);

            // Création du profil spécifique
            Profil::create([
                'user_id' => $user->id,
                'title'   => $u['role'] . ' Expert',
                'bio'     => $u['bio'],
                'skills'  => $u['skills'], // Array de skills spécifiques
                'experiances' => [
                    [
                        'role'        => $u['role'],
                        'company'     => 'YouConnect Inc',
                        'duration'    => '2022 - Présent',
                        'description' => 'Responsable de la partie ' . $u['role'] . ' sur les projets clés.'
                    ],
                    [
                        'role'        => 'Junior ' . $u['role'],
                        'company'     => 'Ancienne Boite',
                        'duration'    => '2020 - 2022',
                        'description' => 'Apprentissage des bases et travail en équipe agile.'
                    ]
                ],
                'projects' => [
                    [
                        'title'    => 'Main Portfolio Project',
                        'category' => 'Development & Design',
                        'image'    => $u['project_img']
                    ]
                ]
            ]);
        }
    }
}