@extends('layouts.app')

@section('title', $offre->title . ' - ' . $entreprise->name . ' - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Main Content (Left, 3 cols) -->
        <div class="lg:col-span-3 space-y-6">

            <!-- Header Card -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-primary-50 to-transparent rounded-bl-3xl"></div>
                
                <div class="flex flex-col md:flex-row gap-6 items-start relative z-10">
                    <div class="w-20 h-20 bg-white rounded-xl flex items-center justify-center shadow-lg border border-slate-100 text-3xl font-black text-slate-900 shrink-0 overflow-hidden">
                        @if($entreprise->logo)
                            <img src="{{ Str::startsWith($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}" alt="{{ $entreprise->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($entreprise->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="flex-grow">
                        <h1 class="text-3xl font-black text-slate-900 font-outfit mb-2">{{ $offre->title }}</h1>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500 font-medium mb-6">
                            <span class="text-slate-900 font-bold hover:underline cursor-pointer">{{ $entreprise->name }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>{{ $entreprise->location }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>{{ $offre->created_at ? \Carbon\Carbon::parse($offre->created_at)->diffForHumans() : 'Récemment' }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span class="text-green-600 bg-green-50 px-2 py-0.5 rounded border border-green-100 text-xs font-bold">{{ $offre->ofres_type }}</span>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            @auth
                                @php
                                    $hasApplied = in_array(auth()->id(), $offre->candidat ?? []);
                                @endphp

                                @if($hasApplied)
                                    <button disabled class="bg-green-100 text-green-700 cursor-not-allowed px-6 py-2.5 rounded-full font-bold transition-all shadow-none flex items-center gap-2">
                                        <span>Candidature envoyée</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </button>
                                @else
                                    <form action="{{ route('offre.postuler', $offre->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-lg shadow-primary-200 flex items-center gap-2">
                                            <span>Postuler</span>
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="bg-slate-900 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-lg hover:bg-slate-800 flex items-center gap-2">
                                    <span>Se connecter pour postuler</span>
                                </a>
                            @endauth
                            <button class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 px-6 py-2.5 rounded-full font-bold transition-all">
                                Sauvegarder
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">À propos de l'offre</h2>
                
                <div class="prose prose-slate max-w-none prose-p:text-slate-600 prose-headings:font-bold prose-headings:text-slate-900">
                    <p class="whitespace-pre-line leading-relaxed">{{ $offre->description }}</p>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100">
                    <h3 class="font-bold text-slate-900 mb-4">Compétences recherchées</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($offre->competences && is_array($offre->competences))
                            @foreach($offre->competences as $skill)
                                <span class="px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-200 transition-colors cursor-default">{{ $skill }}</span>
                            @endforeach
                        @else
                            <span class="text-sm text-slate-500 italic">Aucune compétence spécifique listée.</span>
                        @endif
                    </div>
                </div>
            </div>

             <!-- About Company (Clean LinkedIn style) -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">À propos de l'entreprise</h2>
                <div class="flex items-start gap-4 mb-4">
                     <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center border border-slate-100 text-xl font-black text-slate-900 shrink-0 overflow-hidden">
                        @if($entreprise->logo)
                            <img src="{{ Str::startsWith($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}" alt="{{ $entreprise->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($entreprise->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-lg">{{ $entreprise->name }}</h3>
                        <p class="text-slate-500 text-sm">Services et conseil informatiques</p>
                        <p class="text-slate-500 text-sm">{{ $entreprise->location }}</p>
                    </div>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    Nous sommes une entreprise leader dans le domaine de la technologie, dédiée à l'innovation et à la création de solutions exceptionnelles pour nos clients.
                </p>
                <a href="#" class="text-primary-600 font-bold text-sm hover:underline flex items-center gap-1">
                    Voir la page entreprise
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
            </div>

        </div>

        <!-- Sidebar (Right, 1 col) -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Quick Actions Card (Sticky potentially) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-900 mb-4">Détails de l'offre</h3>
                <div class="space-y-4">
                     <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Type de contrat</p>
                         <p class="text-sm font-bold text-slate-900">{{ $offre->ofres_type }}</p>
                     </div>
                     <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Durée</p>
                         <p class="text-sm font-bold text-slate-900">{{ $offre->durre }}</p>
                     </div>
                     <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Localisation</p>
                         <p class="text-sm font-bold text-slate-900">{{ $entreprise->location }}</p>
                     </div>
                </div>
            </div>

            <!-- Similar Jobs (Placeholder) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-900 mb-4">Offres similaires</h3>
                <div class="space-y-4">
                    <!-- Item 1 -->
                    <div class="flex gap-3 items-start group cursor-pointer">
                        <div class="w-10 h-10 bg-slate-50 rounded flex items-center justify-center shrink-0 font-bold text-slate-700 border border-slate-100">D</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-primary-600 group-hover:underline transition-colors">Développeur Full Stack</h4>
                            <p class="text-xs text-slate-500">Digital Solutions • Rabat</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">Il y a 2 jours</span>
                        </div>
                    </div>
                     <!-- Item 2 -->
                    <div class="flex gap-3 items-start group cursor-pointer">
                        <div class="w-10 h-10 bg-slate-50 rounded flex items-center justify-center shrink-0 font-bold text-slate-700 border border-slate-100">T</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-primary-600 group-hover:underline transition-colors">Tech Lead PHP</h4>
                            <p class="text-xs text-slate-500">Tech Agency • Casa</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">Il y a 5 jours</span>
                        </div>
                    </div>
                </div>
                <button class="w-full mt-4 text-center text-sm font-bold text-slate-500 hover:text-slate-900 py-2 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all">
                    Voir plus d'offres
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
