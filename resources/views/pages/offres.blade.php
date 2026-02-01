@extends('layouts.app')

@section('title', 'Offres d\'emploi - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- LinkedIn-style Header -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Recherche d'emploi</h1>
            <p class="text-slate-500 text-sm">Découvrez les meilleures opportunités pour votre carrière.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-2 rounded-full text-sm font-bold transition-colors">
                Alertes emploi
            </button>
            <button class="bg-primary-600 text-white hover:bg-primary-700 px-4 py-2 rounded-full text-sm font-bold transition-colors shadow-sm">
                Poster une offre
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Filters (Left) -->
        <div class="lg:col-span-1 space-y-4">
             <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
                <h3 class="font-bold text-slate-900 mb-4">Filtres</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Date de publication</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="date" class="text-primary-600 focus:ring-primary-500" checked>
                                <span class="text-sm text-slate-600">Tout</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="date" class="text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-600">Dernières 24h</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="date" class="text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-600">Semaine passée</span>
                            </label>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-slate-100">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Type de contrat</label>
                        <div class="space-y-2">
                             <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-600">CDI</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-600">Stage</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-600">Freelance</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job List (Right) -->
        <div class="lg:col-span-3">
            <div class="space-y-4">
                @foreach($offres as $offre)
                <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md transition-shadow group cursor-pointer relative">
                    <div class="flex items-start gap-4">
                         <!-- Logo -->
                        <div class="w-16 h-16 bg-white rounded-lg border border-slate-100 flex items-center justify-center shrink-0 text-2xl font-black text-slate-900 shadow-sm overflow-hidden group-hover:border-primary-200 transition-colors">
                             @if($offre['entrepris']['logo'])
                                <img src="{{ Str::startsWith($offre['entrepris']['logo'], 'http') ? $offre['entrepris']['logo'] : asset('storage/' . $offre['entrepris']['logo']) }}" alt="{{ $offre['entrepris']['name'] }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($offre['entrepris']['name'], 0, 1) }}
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-primary-600 group-hover:underline mb-1">
                                        <a href="{{ route('offre.details', $offre['offre']['id']) }}">
                                            {{ $offre['offre']['title'] }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-slate-900 font-medium mb-1">{{ $offre['entrepris']['name'] }}</p>
                                    <p class="text-sm text-slate-500 mb-3">{{ $offre['entrepris']['location'] }} ({{ $offre['offre']['type'] }})</p>
                                </div>
                                <button class="text-slate-400 hover:text-slate-900">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                            
                            <div class="flex items-center gap-4 text-xs text-slate-500 font-medium mt-1">
                                @auth
                                    @if(in_array(auth()->id(), $offre['offre']['candidats'] ?? []))
                                         <span class="text-green-600 bg-green-50 px-2 py-1 rounded border border-green-200 font-bold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Candidature envoyée
                                         </span>
                                         <span>•</span>
                                    @endif
                                @endauth
                                <span class="text-green-600 font-bold">{{ \Carbon\Carbon::parse($offre['offre']['created_at'])->diffForHumans() }}</span>
                                <span>•</span>
                                <span>{{ $offre['offre']['durre'] }}</span>
                                @if(isset($offre['applicants_count']))
                                <span>•</span>
                                <span class="text-primary-600 font-bold">{{ $offre['applicants_count'] }} candidats</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
