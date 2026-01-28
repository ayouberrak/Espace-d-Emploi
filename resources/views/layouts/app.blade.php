<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YouConnect - Nadi Elite')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f4ff',
                            100: '#e0eaff',
                            200: '#c7d7fe',
                            300: '#a5bdfd',
                            400: '#819af9',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                        'elite': '0 20px 50px -12px rgba(99, 102, 241, 0.15)',
                        'glow': '0 0 20px rgba(99, 102, 241, 0.3)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-glow': 'pulse-glow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: '0.6' },
                            '50%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .mesh-bg {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.03) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(139, 92, 246, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.03) 0px, transparent 50%);
            background-attachment: fixed;
        }
        .noise-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 50;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="h-full flex flex-col mesh-bg selection:bg-primary-100 antialiased relative">
    <div class="noise-overlay"></div>

    <!-- Navbar Wrapper for floating effect -->
    <div class="fixed top-6 left-0 right-0 z-50 px-4 md:px-8 pointer-events-none">
        <nav class="max-w-7xl mx-auto h-16 flex items-center justify-between glass-card rounded-2xl px-6 shadow-glass pointer-events-auto border-white/50 ring-1 ring-slate-900/5 transition-all">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                <div class="bg-primary-600 p-2 rounded-xl shadow-lg shadow-primary-500/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-slate-900 font-outfit">YouConnect <span class="text-primary-600">.</span></span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center gap-1.5 p-1 bg-slate-100/50 rounded-xl border border-slate-200/50">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-white text-primary-600 shadow-sm ring-1 ring-slate-900/5' : 'text-slate-500 hover:text-slate-900' }}">Talents</a>
                <a href="{{ route('offres') }}" class="px-4 py-2 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('offres') ? 'bg-white text-primary-600 shadow-sm ring-1 ring-slate-900/5' : 'text-slate-500 hover:text-slate-900' }}">offres</a>
                <a href="{{ route('recrutement') }}" class="px-4 py-2 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('recrutement') ? 'bg-white text-primary-600 shadow-sm ring-1 ring-slate-900/5' : 'text-slate-500 hover:text-slate-900' }}">Recruteurs</a>
                <a href="{{ route('networkIndex') }}" class="px-4 py-2 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('networkIndex') ? 'bg-white text-primary-600 shadow-sm ring-1 ring-slate-900/5' : 'text-slate-500 hover:text-slate-900' }}">Réseau</a>
            </div>

            <!-- User Context -->
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primary-700 transition-all shadow-sm">S'inscrire</a>
                @else
                    <!-- Search bar placeholder for desktop -->
                    <div class="hidden md:flex items-center max-w-xs relative mr-2">
                        <svg class="absolute left-3 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Rechercher..." class="w-full bg-slate-100 border-none rounded-full py-2 pl-9 pr-4 text-xs focus:ring-2 focus:ring-primary-500 transition-all outline-none">
                    </div>

                    <!-- Chat Icon -->
                    <a href="{{ route('chat.index') }}" class="relative p-2.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all group {{ request()->routeIs('chat.index') ? 'bg-primary-50 text-primary-600' : '' }}">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span class="absolute top-2.5 right-2 w-2 h-2 bg-indigo-500 rounded-full border-2 border-white"></span>
                    </a>

                    <!-- Notifications -->
                    <div class="relative group cursor-pointer">
                        <button class="relative p-2.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-2.5 right-2.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white ring-2 ring-red-500/20 animate-pulse"></span>
                        </button>
                        
                        <!-- Dropdown (CSS Hover Demo) -->
                        <div class="absolute right-0 top-full mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden transform translate-y-2 group-hover:translate-y-0">
                            <div class="p-4 border-b border-slate-50 flex justify-between items-center">
                                <span class="font-black text-xs uppercase tracking-widest text-slate-400">Notifications</span>
                                <span class="text-[10px] font-bold text-primary-600">Tout marquer comme lu</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                <div class="p-3 hover:bg-slate-50 cursor-pointer flex gap-3 border-b border-slate-50">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-xs">S</div>
                                    <div>
                                        <p class="text-xs text-slate-600"><span class="font-bold text-slate-900">Sarah Tech</span> a vu votre profil.</p>
                                        <p class="text-[10px] text-slate-400 mt-1">Il y a 10 min</p>
                                    </div>
                                </div>
                                <div class="p-3 hover:bg-slate-50 cursor-pointer flex gap-3">
                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-xs">Job</div>
                                    <div>
                                        <p class="text-xs text-slate-600">Nouvelle offre : <span class="font-bold text-slate-900">Lead Dev @Google</span></p>
                                        <p class="text-[10px] text-slate-400 mt-1">Il y a 1h</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Profile & Logout -->
                    <div class="relative group">
                        <button class="flex items-center gap-3 pl-3 border-l border-slate-200">
                            <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-primary-500 to-indigo-600 flex items-center justify-center font-black text-white text-xs uppercase overflow-hidden shadow-lg group-hover:scale-110 transition-transform">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" class="w-full h-full object-cover" alt="">
                                @endif
                            </div>
                            <div class="hidden lg:block text-left">
                                <p class="text-xs font-black text-slate-900 leading-none tracking-tight group-hover:text-primary-600 transition-colors">{{ Auth::user()->name }}</p>
                                <p class="text-[9px] font-black text-primary-500 uppercase tracking-widest mt-0.5">
                                    {{ Auth::user()->role === 'recruiter' ? 'Recruteur' : 'Candidat' }} 
                                    @if(Auth::user()->role === 'devloppeur')
                                        <span class="text-slate-300">|</span> <span class="text-[8px] px-1 bg-amber-100 text-amber-700 rounded-md">Pro</span>
                                    @endif
                                </p>
                            </div>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden transform translate-y-2 group-hover:translate-y-0">
                            <div class="p-2">
                                <a href="{{ route('profile', Auth::id()) }}" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Mon Profil
                                </a>
                                @if(Auth::user()->role === 'recruiter')
                                    <a href="{{ route('recruiter.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                        Dashboard
                                    </a>
                                @endif
                                <div class="h-px bg-slate-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm font-bold text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="flex-grow pt-32">
        @yield('content')
    </main>

    <!-- Elite Footer -->
    <footer class="bg-white border-t border-slate-100 py-12 mt-auto relative overflow-hidden">
        <div class="absolute inset-0 bg-mesh opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="bg-slate-900 p-1.5 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-lg font-black text-slate-900 font-outfit">YouConnect</span>
            </div>
            <p class="text-slate-400 text-sm font-medium">© 2026 YouConnect Inc. Tous droits réservés.</p>
            <div class="flex gap-6">
                <a href="#" class="text-slate-400 hover:text-primary-600 transition-colors font-bold text-xs uppercase tracking-widest">Confidentialité</a>
                <a href="#" class="text-slate-400 hover:text-primary-600 transition-colors font-bold text-xs uppercase tracking-widest">Termes</a>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-6 right-6 z-[200] flex flex-col gap-4 pointer-events-none"></div>

    <!-- Global Scripts -->
    <script>
        // Toast Notification System
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            // Icon based on type
            let icon = '<svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
            if(type === 'info') icon = '<svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            
            toast.className = `pointer-events-auto flex items-center gap-3 bg-white border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.08)] px-5 py-4 rounded-2xl transform transition-all duration-500 translate-y-20 opacity-0`;
            toast.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                    ${icon}
                </div>
                <p class="text-sm font-bold text-slate-900 pr-4">${message}</p>
            `;
            
            container.appendChild(toast);
            
            // Animate In
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
            });
            
            // Remove after 3s
            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        }

        // Welcome Toast on Load
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                showToast('Mode YouConnect Elite activé 🚀', 'success');
            }, 1000);
            
            // Smooth Page Transition
            document.body.classList.add('opacity-100');
            document.body.classList.remove('opacity-0');
        });
    </script>
    <style>
        /* Initial State for Page Transition */
        body {
            transition: opacity 0.5s ease;
        }
    </style>
</body>
</html>
