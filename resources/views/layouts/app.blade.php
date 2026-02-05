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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <script>
        window.userId = {{ auth()->id() ?? 'null' }};
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
    <div class="fixed top-0 left-0 right-0 z-50 pointer-events-none">
        <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/80 to-transparent backdrop-blur-[2px] mask-image-b"></div>
        
        <nav class="max-w-7xl mx-auto h-20 flex items-center justify-between px-6 md:px-8 pointer-events-auto mt-4">
            <!-- Glass Container -->
            <div class="absolute inset-x-4 md:inset-x-8 inset-y-0 bg-white/70 backdrop-filter backdrop-blur-xl border border-white/40 shadow-[0_8px_32px_rgba(0,0,0,0.04)] rounded-full -z-10"></div>

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group pl-2">
                <div class="relative w-10 h-10 flex items-center justify-center bg-gray-900 rounded-xl shadow-lg shadow-indigo-500/20 group-hover:scale-105 group-hover:rotate-3 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-violet-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-lg font-bold tracking-tight text-slate-900 font-outfit group-hover:text-indigo-600 transition-colors">Talentia</span>
            </a>

            <!-- Center Navigation (Desktop) -->
            <div class="hidden md:flex items-center gap-1">
                @foreach([
                    ['route' => 'dashboard', 'label' => 'Accueil', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'networkIndex', 'label' => 'Réseau', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['route' => Auth::check() && Auth::user()->role === 'recruiter'?'mesoffres': 'offres','label' => Auth::check() && Auth::user()->role === 'recruiter' ? 'Mes Offres' :'Offres', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],

                ] as $item)
                <a href="{{ route($item['route']) }}" 
                   class="relative px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 group {{ request()->routeIs($item['route']) ? 'text-slate-900 bg-white shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-2">
                         @if(request()->routeIs($item['route']))
                        <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" /></svg>
                        @endif
                        {{ $item['label'] }}
                    </span>
                    @if(request()->routeIs($item['route']))
                        
                    @endif
                </a>
                @endforeach
            </div>

            <!-- User Actions -->
            <div class="flex items-center gap-4 pr-2">
                @guest
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-all">Connexion</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full text-sm font-bold bg-slate-900 text-white shadow-lg shadow-slate-900/20 hover:bg-indigo-600 hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">S'inscrire</a>
                    </div>
                @else
                    <!-- Search Trigger (Mobile/Desktop) -->
                    <button class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="relative p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if(isset($unreadCount) && $unreadCount > 0)
                                <span id="notification-badge" class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                            @endif
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute right-0 top-full mt-4 w-80 bg-white/90 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-white/50 ring-1 ring-black/5 z-50 overflow-hidden"
                             style="display: none;">
                            
                            <div class="p-4 border-b border-slate-100/50 flex justify-between items-center">
                                <h3 class="font-bold text-slate-900">Notifications</h3>
                                @if(isset($unreadCount) && $unreadCount > 0)
                                    <span class="bg-indigo-100 text-indigo-600 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }} nouvelles</span>
                                @endif
                            </div>

                            <div class="max-h-[300px] overflow-y-auto custom-scrollbar" id="notification-list">
                                @if(isset($notifications) && $notifications->count() > 0)
                                    @foreach($notifications as $notification)
                                        <div class="p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors cursor-pointer relative group">
                                            <p class="text-sm text-slate-600 leading-snug">{{ $notification->data['message'] ?? 'Nouvelle notification' }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                            @if(is_null($notification->read_at))
                                                <span class="absolute top-4 right-4 w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="p-8 text-center text-slate-400 text-sm">
                                        Aucune notification
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-2 border-t border-slate-100/50 text-center">
                                <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Tout marquer comme lu</a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Menu -->
                    <div class="relative group pl-2">
                        <button class="flex items-center gap-3 transition-transform active:scale-95">
                            <div class="w-10 h-10 rounded-full bg-slate-100 p-0.5 shadow-sm ring-2 ring-white cursor-pointer overflow-hidden">
                                @if(Auth::user()->photo)
                                    <img src="{{ Str::startsWith(Auth::user()->photo, 'http') ? Auth::user()->photo : asset('storage/' . Auth::user()->photo) }}" class="w-full h-full rounded-full object-cover transition-transform group-hover:scale-110" alt="">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" class="w-full h-full rounded-full object-cover" alt="">
                                @endif
                            </div>
                        </button>

                        <!-- Modern Dropdown -->
                        <div class="absolute right-0 top-full mt-4 w-60 bg-white/90 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-white/50 ring-1 ring-black/5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right scale-95 group-hover:scale-100 z-50">
                            <div class="p-4 border-b border-slate-100/50">
                                <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 font-medium truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="p-2 space-y-1">
                                <a href="{{ route('profile', Auth::id()) }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Mon Profil
                                </a>
                                @if(Auth::user()->role === 'recruiter')
                                    <a href="{{ route('recruiter.dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                        Espace Recruteur
                                    </a>
                                @endif
                                <a href="{{ route('chat.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                    Messages
                                </a>
                            </div>
                            <div class="p-2 border-t border-slate-100/50">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 text-sm font-medium text-red-600 rounded-xl hover:bg-red-50 transition-colors">
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
    <div id="toast-container" class="fixed top-24 right-6 z-[200] flex flex-col gap-4 pointer-events-none"></div>

    <!-- Global Scripts -->
    <script>
        // Toast Notification System
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            // Icon based on type
            let icon = '<svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
            if(type === 'info') icon = '<svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            if(type === 'error') icon = '<svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            
            toast.className = `pointer-events-auto flex items-center gap-3 bg-white border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.08)] px-5 py-4 rounded-2xl transform transition-all duration-500 translate-x-full opacity-0`;
            toast.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                    ${icon}
                </div>
                <p class="text-sm font-bold text-slate-900 pr-4">${message}</p>
            `;
            
            container.appendChild(toast);
            
            // Animate In
            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            });
            
            // Remove after 4s
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        }

        // Welcome Toast on Load & Session Messages
        document.addEventListener('DOMContentLoaded', () => {
            // Smooth Page Transition
            document.body.classList.add('opacity-100');
            document.body.classList.remove('opacity-0');

            // Session Messages
            @if(session('success'))
                setTimeout(() => showToast("{{ session('success') }}", 'success'), 500);
            @endif

            @if(session('error'))
                setTimeout(() => showToast("{{ session('error') }}", 'error'), 500);
            @endif

            @if(session('info'))
                setTimeout(() => showToast("{{ session('info') }}", 'info'), 500);
            @endif
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
