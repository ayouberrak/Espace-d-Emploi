<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    private $mockUsers = [
        [
            'id' => 1,
            'name' => 'Ahmed Bennani',
            'role' => 'candidate',
            'specialty' => 'Développeur Fullstack',
            'bio' => 'Passionné par React et Laravel. Plus de 5 ans d\'expérience dans le développement d\'applications web modernes.',
            'avatar' => 'https://i.pravatar.cc/150?u=1',
            'skills' => ['React', 'Laravel', 'Tailwind', 'Docker'],
            'company' => null,
        ],
        [
            'id' => 2,
            'name' => 'Oulaya Mansouri',
            'role' => 'recruiter',
            'specialty' => 'RH & Tech Talent',
            'bio' => 'Recruteuse tech chez TechInnov. À la recherche de talents passionnés par l\'innovation.',
            'avatar' => 'https://i.pravatar.cc/150?u=5',
            'skills' => ['Recrutement', 'Sourcing', 'Tech', 'Management'],
            'company' => 'TechInnov SA',
        ],
        [
            'id' => 3,
            'name' => 'Yassine Filali',
            'role' => 'candidate',
            'specialty' => 'Designer UI/UX',
            'bio' => 'Créateur d\'expériences numériques centrées sur l\'utilisateur. Spécialisé en design system et accessibilité.',
            'avatar' => 'https://i.pravatar.cc/150?u=3',
            'skills' => ['Figma', 'Adobe XD', 'Design System', 'CSS'],
            'company' => null,
        ],
        [
            'id' => 4,
            'name' => 'Sami Erraji',
            'role' => 'candidate',
            'specialty' => 'Data Scientist',
            'bio' => 'Expert en analyse de données et machine learning. Passionné par l\'IA appliquée au business.',
            'avatar' => 'https://i.pravatar.cc/150?u=8',
            'skills' => ['Python', 'TensorFlow', 'Pandas', 'SQL'],
            'company' => null,
        ],
        [
            'id' => 5,
            'name' => 'Nadia Tazi',
            'role' => 'recruiter',
            'specialty' => 'Manager Stratégie',
            'bio' => 'Fondatrice de \'Digital Solutions\'. Nous construisons le futur du digital au Maroc.',
            'avatar' => 'https://i.pravatar.cc/150?u=9',
            'skills' => ['Stratégie', 'BizDev', 'Digital', 'Maroc'],
            'company' => 'Digital Solutions',
        ],
    ];

    private $mockInternships = [
        [
            'id' => 101,
            'title' => 'Stage Frontend Developer (React)',
            'company' => 'WebFlow Morocco',
            'location' => 'Casablanca (Remote Poss.)',
            'duration' => '3-6 mois',
            'stipend' => '3000 - 5000 DH',
            'description' => 'Rejoignez notre équipe pour travailler sur des interfaces haut de gamme.',
            'tags' => ['React', 'Tailwind', 'Vite'],
            'is_trending' => true
        ],
        [
            'id' => 102,
            'title' => 'Stagiaire UI/UX Designer',
            'company' => 'Creative Pulse',
            'location' => 'Rabat',
            'duration' => '2-4 mois',
            'stipend' => 'Projet de fin d\'études',
            'description' => 'Aidez-nous à concevoir le futur de l\'e-commerce au Maroc.',
            'tags' => ['Figma', 'Adobe CC', 'Prototypage'],
            'is_trending' => false
        ],
        [
            'id' => 103,
            'title' => 'Stage Data Analyst',
            'company' => 'DataX Analytics',
            'location' => 'Casablanca',
            'duration' => '6 mois',
            'stipend' => '4000 DH',
            'description' => 'Analysez des volumes massifs de données pour nos clients bancaires.',
            'tags' => ['Python', 'SQL', 'Tableau'],
            'is_trending' => true
        ],
    ];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = $this->mockUsers;

        if ($search) {
            $users = array_filter($users, function($user) use ($search) {
                return stripos($user['name'], $search) !== false || 
                       stripos($user['specialty'], $search) !== false;
            });
        }

        return view('users.index', compact('users', 'search'));
    }

    public function stages()
    {
        $stages = $this->mockInternships;
        return view('pages.stages', compact('stages'));
    }

    public function recrutement()
    {
        $recruiters = array_filter($this->mockUsers, function($user) {
            return $user['role'] === 'recruiter';
        });
        return view('pages.recrutement', compact('recruiters'));
    }

    public function profile($id = null)
    {
        // "Me" - The authenticated user (Static Mock)
        $me = [
            'id' => 10,
            'name' => 'Ayoub Errak',
            'role' => 'candidate',
            'specialty' => 'Frontend Engineer',
            'bio' => 'Construit des interfaces premium avec React et Laravel.',
            'avatar' => 'https://i.pravatar.cc/300?u=ayoub',
            'location' => 'Casablanca, Maroc',
            'email' => 'contact@ayoub.dev', 
            'skills' => ['React', 'Tailwind', 'Laravel', 'Blade', 'Figma'],
            'experience' => [
                [
                    'role' => 'Senior Frontend Developer',
                    'company' => 'TechFlow Maroc',
                    'duration' => '2023 - Présent',
                    'description' => 'Lead dev sur la refonte du design system. Architecture React/Next.js.'
                ],
                [
                    'role' => 'Développeur Fullstack',
                    'company' => 'StartUp Hub',
                    'duration' => '2021 - 2023',
                    'description' => 'Développement d\'APIs Laravel et interfaces Vue.js pour des clients MVP.'
                ]
            ],
            'education' => [
                [
                    'degree' => 'Master Big Data & Cloud',
                    'school' => 'ENSIAS',
                    'years' => '2021'
                ],
                [
                    'degree' => 'Licence Génie Informatique',
                    'school' => 'EST Casablanca',
                    'years' => '2019'
                ]
            ],
            'projects' => [
                [
                    'title' => 'E-Commerce Dashboard',
                    'category' => 'React / Tailwind',
                    'image' => 'https://ui-avatars.com/api/?name=Dash&background=6366f1&color=fff&size=128',
                    'link' => '#'
                ],
                [
                    'title' => 'Banking App UI',
                    'category' => 'Figma / UX',
                    'image' => 'https://ui-avatars.com/api/?name=Bank&background=ec4899&color=fff&size=128',
                    'link' => '#'
                ],
                [
                    'title' => 'Delivery API',
                    'category' => 'Laravel / Docker',
                    'image' => 'https://ui-avatars.com/api/?name=API&background=10b981&color=fff&size=128',
                    'link' => '#'
                ]
            ],
        ];

        // If no ID is provided, show "Me"
        if (!$id || $id == 10) {
            $user = $me;
            $isMe = true;
        } else {
            // Find in mock list
            $foundIndex = array_search($id, array_column($this->mockUsers, 'id'));
            
            if ($foundIndex !== false) {
                // Merge basic mock user with some static detail data to make it look full
                $user = array_merge($this->mockUsers[$foundIndex], [
                    'location' => 'Maroc (Ville)',
                    'email' => 'contact@' . strtolower(str_replace(' ', '', $this->mockUsers[$foundIndex]['name'])) . '.com',
                    'experience' => [
                        [
                            'role' => 'Poste Précédent',
                            'company' => 'Entreprise Anonyme',
                            'duration' => '2020 - 2022',
                            'description' => 'Expérience générée pour ce profil de démonstration.'
                        ]
                    ],
                    'education' => [
                        [
                            'degree' => 'Diplôme Supérieur',
                            'school' => 'Université Tech',
                            'years' => '2020'
                        ]
                    ],
                    'projects' => []
                ]);
            } else {
                return abort(404);
            }
            $isMe = false;
        }

        return view('users.profile', compact('user', 'isMe'));
    }
}
